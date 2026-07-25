<?php

declare(strict_types=1);

namespace PottsMemberHelp;

use Fisharebest\Webtrees\Auth;
use Fisharebest\Webtrees\FlashMessages;
use Fisharebest\Webtrees\Http\Exceptions\HttpAccessDeniedException;
use Fisharebest\Webtrees\Http\Exceptions\HttpNotFoundException;
use Fisharebest\Webtrees\Http\RequestHandlers\ControlPanel;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Menu;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleConfigInterface;
use Fisharebest\Webtrees\Module\ModuleConfigTrait;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\ModuleGlobalInterface;
use Fisharebest\Webtrees\Module\ModuleMenuInterface;
use Fisharebest\Webtrees\Module\ModuleMenuTrait;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Services\HtmlService;
use Fisharebest\Webtrees\Services\ModuleService;
use Fisharebest\Webtrees\Services\TreeService;
use Fisharebest\Webtrees\Site;
use Fisharebest\Webtrees\Tree;
use Fisharebest\Webtrees\Validator;
use Fisharebest\Webtrees\View;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function array_filter;
use function array_key_exists;
use function array_map;
use function array_merge;
use function array_unique;
use function count;
use function explode;
use function file_get_contents;
use function in_array;
use function is_array;
use function is_file;
use function is_string;
use function json_encode;
use function mb_strtolower;
use function preg_replace;
use function redirect;
use function route;
use function strip_tags;
use function str_contains;
use function strtolower;
use function strtok;
use function trim;

final class PottsMemberHelp extends AbstractModule implements ModuleMenuInterface, ModuleConfigInterface, ModuleCustomInterface, ModuleGlobalInterface
{
    use ModuleMenuTrait;
    use ModuleConfigTrait;
    use ModuleCustomTrait;

    private const VERSION = '0.4.0-alpha.4';

    private ?HelpRepository $repository = null;

    private ?HtmlService $htmlService = null;

    private ?TreeService $treeService = null;

    private ?ModuleService $moduleService = null;

    public function title(): string
    {
        return I18N::translate('POTTS Member Help Centre');
    }

    public function description(): string
    {
        return I18N::translate('A webtrees-specific visitor and member guide with searchable, audience-aware and module-aware help articles.');
    }

    public function isEnabledByDefault(): bool
    {
        return false;
    }

    public function defaultMenuOrder(): int
    {
        return 9;
    }

    public function getMenu(Tree $tree): Menu|null
    {
        $label = Auth::isMember($tree)
            ? I18N::translate('Member Help')
            : I18N::translate('Visitor Help');

        return new Menu(
            $label,
            route('module', [
                'module' => $this->name(),
                'action' => 'Show',
                'tree' => $tree->name(),
            ]),
            'pmh-menu-help pmh-faq'
        );
    }

    public function boot(): void
    {
        View::registerNamespace('potts-member-help', $this->resourcesFolder() . 'views/');

        $cssFile = $this->resourcesFolder() . 'css/member-help.css';
        $css = is_file($cssFile) ? file_get_contents($cssFile) : false;
        if (is_string($css) && $css !== '') {
            View::pushunique('styles');
            echo '<style data-potts-member-help>' . $css . '</style>';
            View::endpushunique();
        }
    }

    public function headContent(): string
    {
        return '';
    }

    public function bodyContent(): string
    {
        $request = Registry::container()->get(ServerRequestInterface::class);
        $tree = Validator::attributes($request)->treeOptional();

        if (!$tree instanceof Tree) {
            return '';
        }

        $settings = $this->contextualHelpSettings($tree);
        $audience = Auth::isMember($tree)
            ? HelpRepository::AUDIENCE_MEMBERS
            : HelpRepository::AUDIENCE_VISITORS;

        if (!$settings['enabled']) {
            return '';
        }

        if ($audience === HelpRepository::AUDIENCE_VISITORS && !$settings['visitors']) {
            return '';
        }

        if ($audience === HelpRepository::AUDIENCE_MEMBERS && !$settings['members']) {
            return '';
        }

        $contexts = $this->contextualHelpLinks($tree, $audience);
        if ($contexts === []) {
            return '';
        }

        $scriptFile = $this->resourcesFolder() . 'js/contextual-help.js';
        $script = is_file($scriptFile) ? file_get_contents($scriptFile) : false;
        if (!is_string($script) || $script === '') {
            return '';
        }

        $config = [
            'moduleName' => $this->name(),
            'newTab' => $settings['new_tab'],
            'areas' => [
                'individual' => $settings['individual'],
                'family' => $settings['family'],
                'forms' => $settings['forms'],
            ],
            'contexts' => $contexts,
            'openGuideLabel' => I18N::translate('Open guide'),
            'helpIconLabel' => I18N::translate('Help'),
        ];

        $json = json_encode($config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        if (!is_string($json)) {
            return '';
        }

        return '<script data-potts-member-help-context>window.PottsMemberHelpContext=' . $json . ';' . $script . '</script>';
    }

    public function getShowAction(ServerRequestInterface $request): ResponseInterface
    {
        $tree = Validator::attributes($request)->tree();
        [$audience, $actualAudience, $audienceQuery] = $this->resolveAudience($request, $tree);

        $query = trim(Validator::queryParams($request)->string('q', ''));
        $category = trim(Validator::queryParams($request)->string('category', ''));
        $moduleStatus = $this->companionModuleStatus();
        $articles = $this->filterByAvailableModules(
            $this->repository()->articlesForAudience($tree, $audience),
            $moduleStatus
        );
        $categories = $this->visibleCategories($articles);

        if ($category !== '' && array_key_exists($category, $categories)) {
            $articles = $articles->filter(static fn (object $article): bool => $article->category === $category)->values();
        } elseif ($category !== '') {
            $category = '';
        }

        if ($query !== '') {
            $needle = mb_strtolower($query);
            $articles = $articles->filter(static function (object $article) use ($needle): bool {
                $haystack = mb_strtolower($article->title . ' ' . $article->summary . ' ' . strip_tags($article->body));

                return str_contains($haystack, $needle);
            })->values();
        }

        $page = $this->pageText($audience);

        return $this->viewResponse('potts-member-help::index', [
            'articles' => $articles,
            'categories' => $categories,
            'category' => $category,
            'query' => $query,
            'title' => $page['title'],
            'eyebrow' => $page['eyebrow'],
            'intro' => $page['intro'],
            'searchPlaceholder' => $page['search_placeholder'],
            'audience' => $audience,
            'actualAudience' => $actualAudience,
            'audienceQuery' => $audienceQuery,
            'tree' => $tree,
            'moduleName' => $this->name(),
            'moduleRequirements' => $this->companionModules(),
        ]);
    }

    public function getArticleAction(ServerRequestInterface $request): ResponseInterface
    {
        $tree = Validator::attributes($request)->tree();
        [$audience, $actualAudience, $audienceQuery] = $this->resolveAudience($request, $tree);

        $moduleStatus = $this->companionModuleStatus();
        $visibleArticles = $this->filterByAvailableModules(
            $this->repository()->articlesForAudience($tree, $audience),
            $moduleStatus
        );
        $slug = Validator::queryParams($request)->string('slug');
        $article = $visibleArticles->first(static fn (object $item): bool => $item->slug === $slug);
        if ($article === null) {
            throw new HttpNotFoundException(I18N::translate('This help article could not be found.'));
        }

        $categories = $this->visibleCategories($visibleArticles);
        $related = $visibleArticles
            ->filter(static fn (object $item): bool => $item->category === $article->category && $item->slug !== $article->slug)
            ->take(4)
            ->values();
        $page = $this->pageText($audience);

        return $this->viewResponse('potts-member-help::article', [
            'article' => $article,
            'categories' => $categories,
            'related' => $related,
            'title' => $article->title,
            'helpTitle' => $page['title'],
            'audience' => $audience,
            'actualAudience' => $actualAudience,
            'audienceQuery' => $audienceQuery,
            'tree' => $tree,
            'moduleName' => $this->name(),
            'moduleRequirements' => $this->companionModules(),
            'feedbackRecorded' => Validator::queryParams($request)->string('feedback', '') === 'recorded',
        ]);
    }

    public function postFeedbackAction(ServerRequestInterface $request): ResponseInterface
    {
        $tree = Validator::attributes($request)->tree();
        $slug = trim(Validator::parsedBody($request)->string('slug'));
        $vote = Validator::parsedBody($request)->string('vote');

        if ($slug === '' || !in_array($vote, ['yes', 'no'], true)) {
            throw new HttpAccessDeniedException();
        }

        $audience = Auth::isMember($tree)
            ? HelpRepository::AUDIENCE_MEMBERS
            : HelpRepository::AUDIENCE_VISITORS;
        $visibleArticles = $this->filterByAvailableModules(
            $this->repository()->articlesForAudience($tree, $audience),
            $this->companionModuleStatus()
        );
        $article = $visibleArticles->first(static fn (object $item): bool => $item->slug === $slug);

        if ($article === null) {
            throw new HttpNotFoundException(I18N::translate('This help article could not be found.'));
        }

        $feedbackSession = $_SESSION['potts_member_help_feedback'] ?? [];
        if (!is_array($feedbackSession)) {
            $feedbackSession = [];
        }
        $feedbackKey = $tree->id() . ':' . $slug;

        if (!array_key_exists($feedbackKey, $feedbackSession)) {
            if (!$this->repository()->recordFeedback($tree, $slug, $vote === 'yes')) {
                throw new HttpNotFoundException(I18N::translate('This help article could not be found.'));
            }

            $feedbackSession[$feedbackKey] = $vote;
            $_SESSION['potts_member_help_feedback'] = $feedbackSession;
        }

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Article',
            'tree' => $tree->name(),
            'slug' => $slug,
            'feedback' => 'recorded',
        ]) . '#pmh-feedback');
    }

    public function getAdminAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $this->layout = 'layouts/administration';

        $tree = Validator::attributes($request)->treeOptional();
        if (!$tree instanceof Tree) {
            $trees = $this->treeService()->all();
            $tree = $trees->get(Site::getPreference('DEFAULT_GEDCOM')) ?? $trees->first();

            if ($tree instanceof Tree) {
                return redirect(route('module', [
                    'module' => $this->name(),
                    'action' => 'Admin',
                    'tree' => $tree->name(),
                ]));
            }

            return redirect(route(ControlPanel::class));
        }

        $this->repository()->ensureSeeded($tree);
        $articles = $this->repository()->articles($tree, true);

        return $this->viewResponse('potts-member-help::admin', [
            'articles' => $articles,
            'categories' => $this->repository()->categories(),
            'audiences' => $this->repository()->audiences(),
            'missingDefaults' => $this->repository()->missingDefaultCount($tree),
            'title' => $this->title() . ' — ' . $tree->title(),
            'tree' => $tree,
            'treeNames' => $this->treeService()->titles(),
            'moduleName' => $this->name(),
            'version' => self::VERSION,
            'moduleRequirements' => $this->companionModules(),
            'moduleStatus' => $this->companionModuleStatus(),
            'feedbackTotals' => [
                'yes' => (int) $articles->sum('feedback_yes'),
                'no' => (int) $articles->sum('feedback_no'),
            ],
            'contextualSettings' => $this->contextualHelpSettings($tree),
        ]);
    }

    public function postAdminAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Admin',
            'tree' => Validator::parsedBody($request)->string('tree'),
        ]));
    }

    public function postAdminContextAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();

        foreach ([
            'enabled',
            'visitors',
            'members',
            'individual',
            'family',
            'forms',
            'new_tab',
        ] as $setting) {
            $value = Validator::parsedBody($request)->boolean($setting, false) ? '1' : '0';
            $this->setPreference($this->contextualPreferenceKey($tree, $setting), $value);
        }

        FlashMessages::addMessage(
            I18N::translate('Contextual help settings were saved.'),
            'success'
        );

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Admin',
            'tree' => $tree->name(),
        ]));
    }

    public function postAdminSeedAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();
        $added = $this->repository()->seedMissingDefaults($tree);

        FlashMessages::addMessage(
            I18N::translate('%s missing starter articles were added.', (string) $added),
            'success'
        );

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Admin',
            'tree' => $tree->name(),
        ]));
    }

    public function postAdminRefreshAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();
        $result = $this->repository()->replaceStarterArticles($tree);

        FlashMessages::addMessage(
            I18N::translate(
                '%s starter articles were updated and %s were added. Custom articles with other link names were preserved.',
                (string) $result['updated'],
                (string) $result['added']
            ),
            'success'
        );

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Admin',
            'tree' => $tree->name(),
        ]));
    }

    public function getAdminEditAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $this->layout = 'layouts/administration';

        $tree = Validator::attributes($request)->tree();
        $this->repository()->ensureSeeded($tree);
        $blockId = Validator::queryParams($request)->integer('block_id', 0);
        $article = $blockId > 0 ? $this->repository()->findById($tree, $blockId) : null;

        if ($blockId > 0 && $article === null) {
            throw new HttpNotFoundException(I18N::translate('This help article could not be found.'));
        }

        if ($article === null) {
            $article = (object) [
                'block_id' => 0,
                'block_order' => $this->repository()->nextOrder($tree),
                'title' => '',
                'slug' => '',
                'category' => 'getting-started',
                'summary' => '',
                'body' => '',
                'audience' => HelpRepository::AUDIENCE_MEMBERS,
                'requires_modules' => '',
                'published' => true,
            ];
        }

        return $this->viewResponse('potts-member-help::editor', [
            'article' => $article,
            'categories' => $this->repository()->categories(),
            'audiences' => $this->repository()->audiences(),
            'title' => $blockId > 0 ? I18N::translate('Edit help article') : I18N::translate('Add help article'),
            'tree' => $tree,
            'moduleName' => $this->name(),
            'moduleRequirements' => $this->companionModules(),
            'moduleStatus' => $this->companionModuleStatus(),
            'richTextEditorAvailable' => $this->richTextEditorAvailable(),
        ]);
    }

    public function postAdminEditAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();
        $blockId = Validator::queryParams($request)->integer('block_id', 0);

        $title = trim(Validator::parsedBody($request)->string('title'));
        if ($title === '') {
            throw new HttpAccessDeniedException();
        }

        $category = Validator::parsedBody($request)->string('category');
        if (!array_key_exists($category, $this->repository()->categories())) {
            $category = 'getting-started';
        }

        $audience = Validator::parsedBody($request)->string('audience', HelpRepository::AUDIENCE_MEMBERS);
        if (!array_key_exists($audience, $this->repository()->audiences())) {
            $audience = HelpRepository::AUDIENCE_MEMBERS;
        }

        $parsedBody = $request->getParsedBody();
        $requestedModules = is_array($parsedBody) && isset($parsedBody['requires_modules']) && is_array($parsedBody['requires_modules'])
            ? $parsedBody['requires_modules']
            : [];
        $knownModules = $this->companionModules();
        $requiresModules = array_values(array_filter(
            array_map(static fn (mixed $value): string => trim((string) $value), $requestedModules),
            static fn (string $value): bool => array_key_exists($value, $knownModules)
        ));

        $body = $this->htmlService()->sanitize(Validator::parsedBody($request)->string('body'));
        $summary = trim(strip_tags(Validator::parsedBody($request)->string('summary')));

        $this->repository()->save($tree, [
            'title' => $title,
            'slug' => Validator::parsedBody($request)->string('slug', $title),
            'category' => $category,
            'summary' => $summary,
            'body' => $body,
            'audience' => $audience,
            'requires_modules' => $requiresModules,
            'published' => Validator::parsedBody($request)->boolean('published', false),
            'block_order' => Validator::parsedBody($request)->integer('block_order', 1),
        ], $blockId);

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Admin',
            'tree' => $tree->name(),
        ]));
    }

    public function postAdminDeleteAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();
        $blockId = Validator::queryParams($request)->integer('block_id');
        $this->repository()->delete($tree, $blockId);

        return redirect(route('module', [
            'module' => $this->name(),
            'action' => 'Admin',
            'tree' => $tree->name(),
        ]));
    }

    /** @return array{0:string,1:string,2:string} */
    private function resolveAudience(ServerRequestInterface $request, Tree $tree): array
    {
        $actualAudience = Auth::isMember($tree)
            ? HelpRepository::AUDIENCE_MEMBERS
            : HelpRepository::AUDIENCE_VISITORS;
        $audience = $actualAudience;
        $requested = Validator::queryParams($request)->string('audience', '');

        if (Auth::isAdmin() && in_array($requested, [HelpRepository::AUDIENCE_VISITORS, HelpRepository::AUDIENCE_MEMBERS], true)) {
            $audience = $requested;
        }

        return [$audience, $actualAudience, $audience === $actualAudience ? '' : $audience];
    }

    /** @return array<string,array{title:string,description:string,group:string}> */
    private function visibleCategories(Collection $articles): array
    {
        $used = $articles->pluck('category')->unique()->all();

        return array_filter(
            $this->repository()->categories(),
            static fn (string $key): bool => in_array($key, $used, true),
            ARRAY_FILTER_USE_KEY
        );
    }

    /** @return array{title:string,eyebrow:string,intro:string,search_placeholder:string} */
    private function pageText(string $audience): array
    {
        if ($audience === HelpRepository::AUDIENCE_VISITORS) {
            return [
                'title' => I18N::translate('Visitor Help Centre'),
                'eyebrow' => I18N::translate('A practical guide to this webtrees website'),
                'intro' => I18N::translate('Learn how webtrees organises people and families, how to search and use charts, what the Biography and other optional features show and how privacy works.'),
                'search_placeholder' => I18N::translate('Search for Biography, relationships, privacy, charts…'),
            ];
        }

        return [
            'title' => I18N::translate('POTTS Member Help Centre'),
            'eyebrow' => I18N::translate('Webtrees editing and contribution guide'),
            'intro' => I18N::translate('Use the correct webtrees tabs to add people, relationships, facts, events, media and sources, then understand how those records feed Biography and other optional modules.'),
            'search_placeholder' => I18N::translate('Search for Families, Facts and events, Biography, photos…'),
        ];
    }

    /** @return array<string,string> */
    private function companionModules(): array
    {
        return [
            '_potts_life_story_engine_' => I18N::translate('Potts Biography'),
            '_potts_relationship_context_' => I18N::translate('Potts Relationship Context'),
            '_potts_historical_facts_' => I18N::translate('Potts Historical Facts'),
            '_potts_fact_ages_' => I18N::translate('Potts Fact Ages'),
            '_potts_modern_theme_' => I18N::translate('Potts Modern Theme'),
        ];
    }

    /** @return array<string,bool> */
    private function companionModuleStatus(): array
    {
        $status = [];
        foreach ($this->companionModules() as $moduleName => $label) {
            $status[$moduleName] = $this->moduleService()->findByName($moduleName) !== null;
        }

        return $status;
    }

    /** @param array<string,bool> $moduleStatus
     *  @return Collection<int,object>
     */
    private function filterByAvailableModules(Collection $articles, array $moduleStatus): Collection
    {
        return $articles->filter(function (object $article) use ($moduleStatus): bool {
            foreach ($this->requiredModuleNames($article) as $moduleName) {
                if (($moduleStatus[$moduleName] ?? false) !== true) {
                    return false;
                }
            }

            return true;
        })->values();
    }

    /** @return list<string> */
    private function requiredModuleNames(object $article): array
    {
        $raw = trim((string) ($article->requires_modules ?? ''));
        if ($raw === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    /** @return array{enabled:bool,visitors:bool,members:bool,individual:bool,family:bool,forms:bool,new_tab:bool} */
    private function contextualHelpSettings(Tree $tree): array
    {
        return [
            'enabled' => $this->getPreference($this->contextualPreferenceKey($tree, 'enabled'), '1') === '1',
            'visitors' => $this->getPreference($this->contextualPreferenceKey($tree, 'visitors'), '1') === '1',
            'members' => $this->getPreference($this->contextualPreferenceKey($tree, 'members'), '1') === '1',
            'individual' => $this->getPreference($this->contextualPreferenceKey($tree, 'individual'), '1') === '1',
            'family' => $this->getPreference($this->contextualPreferenceKey($tree, 'family'), '1') === '1',
            'forms' => $this->getPreference($this->contextualPreferenceKey($tree, 'forms'), '1') === '1',
            'new_tab' => $this->getPreference($this->contextualPreferenceKey($tree, 'new_tab'), '1') === '1',
        ];
    }

    private function contextualPreferenceKey(Tree $tree, string $setting): string
    {
        return 'contextual_' . $tree->id() . '_' . $setting;
    }

    /** @return array<string,array{url:string,message:string,label:string}> */
    private function contextualHelpLinks(Tree $tree, string $audience): array
    {
        $articles = $this->filterByAvailableModules(
            $this->repository()->articlesForAudience($tree, $audience),
            $this->companionModuleStatus()
        )->keyBy('slug');

        $definitions = $this->contextualDefinitions($audience);
        $links = [];

        foreach ($definitions as $context => $definition) {
            $slug = $definition['slug'];
            if (!$articles->has($slug)) {
                continue;
            }

            $links[$context] = [
                'url' => route('module', [
                    'module' => $this->name(),
                    'action' => 'Article',
                    'tree' => $tree->name(),
                    'slug' => $slug,
                ]),
                'message' => $definition['message'],
                'label' => $definition['label'],
            ];
        }

        return $links;
    }

    /** @return array<string,array{slug:string,message:string,label:string}> */
    private function contextualDefinitions(string $audience): array
    {
        $visitor = $audience === HelpRepository::AUDIENCE_VISITORS;

        return [
            'individual-page' => [
                'slug' => $visitor ? 'understand-individual-page-tabs' : 'choose-correct-tab-for-change',
                'message' => I18N::translate('Need help understanding this person’s page?'),
                'label' => I18N::translate('Guide to this page'),
            ],
            'individual-biography' => [
                'slug' => $visitor ? 'what-the-biography-tab-shows' : 'why-biography-cannot-be-edited-directly',
                'message' => I18N::translate('Need help with the Biography tab?'),
                'label' => I18N::translate('Biography help'),
            ],
            'individual-facts' => [
                'slug' => $visitor ? 'use-facts-and-events-tab' : 'add-a-fact-or-event',
                'message' => I18N::translate('Need help with Facts and events?'),
                'label' => I18N::translate('Facts and events help'),
            ],
            'individual-families' => [
                'slug' => $visitor ? 'use-families-tab' : 'choose-correct-tab-for-change',
                'message' => I18N::translate('Need help with family relationships?'),
                'label' => I18N::translate('Families help'),
            ],
            'individual-media' => [
                'slug' => $visitor ? 'using-photographs-and-information' : 'add-a-photograph-or-document',
                'message' => I18N::translate('Need help with photographs and documents?'),
                'label' => I18N::translate('Media help'),
            ],
            'family-page' => [
                'slug' => $visitor ? 'follow-family-links' : 'correct-family-relationship',
                'message' => I18N::translate('Need help understanding or updating this family?'),
                'label' => I18N::translate('Family help'),
            ],
            'create-person' => [
                'slug' => 'create-a-new-person',
                'message' => I18N::translate('Need help creating this person?'),
                'label' => I18N::translate('Create a person guide'),
            ],
            'add-partner' => [
                'slug' => 'add-a-partner',
                'message' => I18N::translate('Need help adding a partner?'),
                'label' => I18N::translate('Add a partner guide'),
            ],
            'add-child' => [
                'slug' => 'add-a-child',
                'message' => I18N::translate('Need help adding a child?'),
                'label' => I18N::translate('Add a child guide'),
            ],
            'add-parent' => [
                'slug' => 'add-or-correct-parents',
                'message' => I18N::translate('Need help adding or correcting parents?'),
                'label' => I18N::translate('Parents guide'),
            ],
            'edit-name' => [
                'slug' => 'correct-a-name',
                'message' => I18N::translate('Need help changing a name?'),
                'label' => I18N::translate('Name editing guide'),
            ],
            'add-fact' => [
                'slug' => 'add-a-fact-or-event',
                'message' => I18N::translate('Need help adding a fact or event?'),
                'label' => I18N::translate('Add an event guide'),
            ],
            'edit-fact' => [
                'slug' => 'edit-or-remove-event',
                'message' => I18N::translate('Need help editing or removing this event?'),
                'label' => I18N::translate('Edit an event guide'),
            ],
            'add-media' => [
                'slug' => 'add-a-photograph-or-document',
                'message' => I18N::translate('Need help adding a photograph or document?'),
                'label' => I18N::translate('Add media guide'),
            ],
            'source-citation' => [
                'slug' => 'add-source-and-citation',
                'message' => I18N::translate('Need help adding a source or citation?'),
                'label' => I18N::translate('Sources and citations guide'),
            ],
            'close-relative-events' => [
                'slug' => $visitor ? 'what-are-events-of-close-relatives' : 'show-hide-close-relative-events',
                'message' => I18N::translate('Need help with events of close relatives?'),
                'label' => I18N::translate('Close-relative events help'),
            ],
            'relationship-options' => [
                'slug' => $visitor ? 'turn-relationship-labels-on-or-off' : 'relationship-reference-person',
                'message' => I18N::translate('Need help with relationship options?'),
                'label' => I18N::translate('Relationship options help'),
            ],
            'historical-context' => [
                'slug' => $visitor ? 'choose-historical-collections' : 'control-facts-events-displays',
                'message' => I18N::translate('Need help with historical context?'),
                'label' => I18N::translate('Historical context help'),
            ],
        ];
    }

    private function assertAdmin(): void
    {
        if (!Auth::isAdmin()) {
            throw new HttpAccessDeniedException();
        }
    }

    private function richTextEditorAvailable(): bool
    {
        return $this->moduleService()->findByName('ckeditor') !== null;
    }

    private function repository(): HelpRepository
    {
        return $this->repository ??= new HelpRepository(
            $this->name(),
            __DIR__ . '/resources/data/default-articles.php'
        );
    }

    private function htmlService(): HtmlService
    {
        return $this->htmlService ??= Registry::container()->get(HtmlService::class);
    }

    private function treeService(): TreeService
    {
        return $this->treeService ??= Registry::container()->get(TreeService::class);
    }

    private function moduleService(): ModuleService
    {
        return $this->moduleService ??= Registry::container()->get(ModuleService::class);
    }

    public function resourcesFolder(): string
    {
        return __DIR__ . '/resources/';
    }

    public function customModuleVersion(): string
    {
        return self::VERSION;
    }

    public function customModuleAuthorName(): string
    {
        return 'Jason Potts';
    }

    public function customModuleSupportUrl(): string
    {
        return 'https://github.com/PottsNet/potts-member-help/issues';
    }

    public function customModuleLatestVersionUrl(): string
    {
        return 'https://raw.githubusercontent.com/PottsNet/potts-member-help/main/latest-version.txt';
    }

    /** @return array<string,string> */
    public function customTranslations(string $language): array
    {
        $language = preg_replace('/[^A-Za-z0-9_-]/', '', trim($language)) ?? '';
        $candidates = array_filter([
            $language,
            strtolower($language),
            strtolower(strtok(str_replace('_', '-', $language), '-') ?: ''),
        ]);

        $translations = [];
        foreach (array_unique($candidates) as $candidate) {
            $file = $this->resourcesFolder() . 'lang/' . $candidate . '.php';
            if (is_file($file)) {
                $loaded = include $file;
                if (is_array($loaded)) {
                    $translations = array_merge($translations, $loaded);
                }
            }
        }

        return $translations;
    }
}
