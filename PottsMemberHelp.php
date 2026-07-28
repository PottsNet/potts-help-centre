<?php

declare(strict_types=1);

namespace PottsMemberHelp;

use Fisharebest\Webtrees\Auth;
use Fisharebest\Webtrees\FlashMessages;
use Fisharebest\Webtrees\Http\Exceptions\HttpAccessDeniedException;
use Fisharebest\Webtrees\Http\Exceptions\HttpNotFoundException;
use Fisharebest\Webtrees\Http\RequestHandlers\ContactPage;
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
use Fisharebest\Webtrees\Services\MessageService;
use Fisharebest\Webtrees\Services\ModuleService;
use Fisharebest\Webtrees\Services\TreeService;
use Fisharebest\Webtrees\Site;
use Fisharebest\Webtrees\Tree;
use Fisharebest\Webtrees\Validator;
use Fisharebest\Webtrees\View;
use Illuminate\Support\Collection;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function array_filter;
use function array_key_exists;
use function array_map;
use function array_merge;
use function array_unique;
use function array_values;
use function ceil;
use function count;
use function explode;
use function file_get_contents;
use function in_array;
use function is_array;
use function is_file;
use function is_string;
use function json_decode;
use function json_encode;
use function mb_strtolower;
use function preg_replace;
use function preg_split;
use function redirect;
use function route;
use function strip_tags;
use function str_word_count;
use function str_contains;
use function str_replace;
use function strtolower;
use function strtok;
use function trim;

final class PottsMemberHelp extends AbstractModule implements ModuleMenuInterface, ModuleConfigInterface, ModuleCustomInterface, ModuleGlobalInterface
{
    use ModuleMenuTrait;
    use ModuleConfigTrait;
    use ModuleCustomTrait;

    private const VERSION = '1.0.0-rc.2';

    private ?HelpRepository $repository = null;

    private ?HtmlService $htmlService = null;

    private ?TreeService $treeService = null;

    private ?ModuleService $moduleService = null;

    public function title(): string
    {
        return I18N::translate('Potts Help Centre');
    }

    public function description(): string
    {
        return I18N::translate('An inclusive webtrees help centre for visitors and members, with searchable, contextual and module-aware guidance.');
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
        return new Menu(
            I18N::translate('Help'),
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
        $output = '';
        $helpScriptFile = $this->resourcesFolder() . 'js/help-centre.js';
        $helpScript = is_file($helpScriptFile) ? file_get_contents($helpScriptFile) : false;
        if (is_string($helpScript) && $helpScript !== '') {
            $output .= '<script data-potts-help-centre>' . $helpScript . '</script>';
        }

        $request = Registry::container()->get(ServerRequestInterface::class);
        $tree = Validator::attributes($request)->treeOptional();

        if (!$tree instanceof Tree) {
            return $output;
        }

        $settings = $this->contextualHelpSettings($tree);
        $audience = Auth::isMember($tree)
            ? HelpRepository::AUDIENCE_MEMBERS
            : HelpRepository::AUDIENCE_VISITORS;

        if (!$settings['enabled']) {
            return $output;
        }

        if ($audience === HelpRepository::AUDIENCE_VISITORS && !$settings['visitors']) {
            return $output;
        }

        if ($audience === HelpRepository::AUDIENCE_MEMBERS && !$settings['members']) {
            return $output;
        }

        $contexts = $this->contextualHelpLinks($tree, $audience);
        if ($contexts === []) {
            return $output;
        }

        $scriptFile = $this->resourcesFolder() . 'js/contextual-help.js';
        $script = is_file($scriptFile) ? file_get_contents($scriptFile) : false;
        if (!is_string($script) || $script === '') {
            return $output;
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
            'openGuideLabel' => I18N::translate('Help with this page'),
            'helpIconLabel' => I18N::translate('Help'),
        ];

        $json = json_encode($config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        if (!is_string($json)) {
            return $output;
        }

        return $output . '<script data-potts-member-help-context>window.PottsMemberHelpContext=' . $json . ';' . $script . '</script>';
    }

    public function getShowAction(ServerRequestInterface $request): ResponseInterface
    {
        $tree = Validator::attributes($request)->tree();
        $this->ensureFeaturedUpgrade($tree);
        $this->ensureScreenshotUpgrade($tree);
        $this->ensureRc2ContentUpgrade($tree);
        [$audience, $actualAudience, $audienceQuery] = $this->resolveAudience($request, $tree);
        $language = I18N::languageTag();

        $query = trim(Validator::queryParams($request)->string('q', ''));
        $category = trim(Validator::queryParams($request)->string('category', ''));
        $showAll = Validator::queryParams($request)->string('view', '') === 'all';
        $moduleStatus = $this->companionModuleStatus();
        $allArticles = $this->filterByAvailableModules(
            $this->repository()->articlesForAudience($tree, $audience, false, $language),
            $moduleStatus
        );
        $categories = $this->visibleCategories($allArticles);
        $categoryCounts = $allArticles
            ->groupBy('category')
            ->map(static fn (Collection $items): int => $items->count())
            ->all();
        $quickHelp = $this->featuredArticles($allArticles, $audience);
        $articles = $allArticles;

        if ($category !== '' && array_key_exists($category, $categories)) {
            $articles = $articles->filter(static fn (object $article): bool => $article->category === $category)->values();
        } elseif ($category !== '') {
            $category = '';
        }

        if ($query !== '') {
            $articles = $this->searchArticles($articles, $query, $categories);
        }

        $page = $this->pageText($audience);

        return $this->viewResponse('potts-member-help::index', [
            'articles' => $articles,
            'categories' => $categories,
            'categoryCounts' => $categoryCounts,
            'category' => $category,
            'query' => $query,
            'resultCount' => $articles->count(),
            'totalCount' => $allArticles->count(),
            'showAll' => $showAll,
            'quickHelp' => $quickHelp,
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
            'language' => $language,
            'hasLanguageFallbacks' => $allArticles->contains(static fn (object $article): bool => (bool) ($article->is_language_fallback ?? false)),
        ]);
    }

    /**
     * Handle search as POST and redirect back to the Help Centre. This preserves
     * the module route on installations that do not use pretty URLs.
     */
    public function postSearchAction(ServerRequestInterface $request): ResponseInterface
    {
        $tree = Validator::attributes($request)->tree();
        $parameters = [
            'module' => $this->name(),
            'action' => 'Show',
            'tree' => $tree->name(),
        ];

        foreach (['q', 'category', 'audience'] as $name) {
            $value = trim(Validator::parsedBody($request)->string($name, ''));
            if ($value !== '') {
                $parameters[$name] = $value;
            }
        }

        return redirect(route('module', $parameters));
    }

    public function getArticleAction(ServerRequestInterface $request): ResponseInterface
    {
        $tree = Validator::attributes($request)->tree();
        $this->ensureScreenshotUpgrade($tree);
        $this->ensureRc2ContentUpgrade($tree);
        [$audience, $actualAudience, $audienceQuery] = $this->resolveAudience($request, $tree);
        $language = I18N::languageTag();

        $moduleStatus = $this->companionModuleStatus();
        $allAudienceVariants = $this->filterByAvailableModules(
            $this->repository()->articlesForAudience($tree, $audience, false),
            $moduleStatus
        );
        $visibleArticles = $this->repository()->selectLanguage($allAudienceVariants, $language);
        $slug = Validator::queryParams($request)->string('slug');
        $requestedArticle = $allAudienceVariants->first(static fn (object $item): bool => $item->slug === $slug);
        if ($requestedArticle === null) {
            throw new HttpNotFoundException(I18N::translate('This help article could not be found.'));
        }
        $translationKey = (string) ($requestedArticle->translation_key ?? $requestedArticle->slug);
        $article = $visibleArticles->first(static fn (object $item): bool => (string) ($item->translation_key ?? $item->slug) === $translationKey)
            ?? $requestedArticle;
        if ($article->slug !== $slug) {
            $parameters = [
                'module' => $this->name(),
                'action' => 'Article',
                'tree' => $tree->name(),
                'slug' => $article->slug,
            ];
            if ($audienceQuery !== '') {
                $parameters['audience'] = $audienceQuery;
            }

            return redirect(route('module', $parameters));
        }

        $categories = $this->visibleCategories($visibleArticles);
        $related = $visibleArticles
            ->filter(static fn (object $item): bool => $item->category === $article->category && $item->slug !== $article->slug)
            ->take(4)
            ->values();
        $position = $visibleArticles->search(static fn (object $item): bool => $item->slug === $article->slug);
        $previous = is_int($position) && $position > 0 ? $visibleArticles->get($position - 1) : null;
        $next = is_int($position) && $position < $visibleArticles->count() - 1 ? $visibleArticles->get($position + 1) : null;
        $feedbackSession = $_SESSION['potts_member_help_feedback'] ?? [];
        $feedbackKey = $tree->id() . ':' . $article->slug;
        $feedbackGiven = is_array($feedbackSession) && array_key_exists($feedbackKey, $feedbackSession);
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
            'readingTime' => $this->readingTime((string) $article->body),
            'previous' => $previous,
            'next' => $next,
            'feedbackGiven' => $feedbackGiven,
            'feedbackRecorded' => $feedbackGiven && Validator::queryParams($request)->string('feedback', '') === 'recorded',
            'screenshotUrl' => $this->articleScreenshotUrl($article),
            'resourceLinks' => $this->repository()->resourceLinks($article),
            'officialResources' => $this->officialResources(),
            'contactUrl' => $this->contactUrl($tree, $article),
            'language' => $language,
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
            $this->repository()->articlesForAudience($tree, $audience, false, I18N::languageTag()),
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
        $this->ensureFeaturedUpgrade($tree);
        $this->ensureScreenshotUpgrade($tree);
        $this->ensureRc2ContentUpgrade($tree);
        $articles = $this->repository()->articles($tree, true);
        $publishedArticles = $articles->filter(static fn (object $article): bool => $article->published === true);
        $feedbackYes = (int) $articles->sum('feedback_yes');
        $feedbackNo = (int) $articles->sum('feedback_no');
        $feedbackResponses = $feedbackYes + $feedbackNo;
        $languageCounts = $articles->groupBy('language')->map(static fn (Collection $items): int => $items->count())->sortKeys();
        $attentionArticles = $articles
            ->filter(static fn (object $article): bool => ((int) ($article->feedback_yes ?? 0) + (int) ($article->feedback_no ?? 0)) >= 2)
            ->sortByDesc(static function (object $article): float {
                $yes = (int) ($article->feedback_yes ?? 0);
                $no = (int) ($article->feedback_no ?? 0);
                $total = $yes + $no;

                return $total > 0 ? $no / $total : 0.0;
            })
            ->take(5)
            ->values();

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
                'yes' => $feedbackYes,
                'no' => $feedbackNo,
            ],
            'dashboard' => [
                'total' => $articles->count(),
                'published' => $publishedArticles->count(),
                'drafts' => $articles->count() - $publishedArticles->count(),
                'visitors' => $articles->where('audience', HelpRepository::AUDIENCE_VISITORS)->count(),
                'members' => $articles->where('audience', HelpRepository::AUDIENCE_MEMBERS)->count(),
                'everyone' => $articles->where('audience', HelpRepository::AUDIENCE_EVERYONE)->count(),
                'featured' => $articles->filter(static fn (object $article): bool => (bool) ($article->featured ?? false))->count(),
                'screenshots' => $articles->filter(static fn (object $article): bool => trim((string) ($article->screenshot ?? '')) !== '')->count(),
                'languages' => $languageCounts->count(),
                'helpful_rate' => $feedbackResponses > 0 ? (int) round(($feedbackYes / $feedbackResponses) * 100) : null,
            ],
            'attentionArticles' => $attentionArticles,
            'contextualSettings' => $this->contextualHelpSettings($tree),
            'languageCounts' => $languageCounts->all(),
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

    public function postAdminLanguageExportAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();
        $language = $this->repository()->normaliseLanguage(
            Validator::parsedBody($request)->string('language', HelpRepository::DEFAULT_LANGUAGE)
        );

        $articles = $this->repository()->articles($tree, true)
            ->filter(static fn (object $article): bool => (string) ($article->language ?? HelpRepository::DEFAULT_LANGUAGE) === $language)
            ->map(fn (object $article): array => [
                'title' => (string) $article->title,
                'slug' => (string) $article->slug,
                'translation_key' => (string) ($article->translation_key ?? $article->slug),
                'language' => (string) ($article->language ?? HelpRepository::DEFAULT_LANGUAGE),
                'category' => (string) $article->category,
                'summary' => (string) $article->summary,
                'body' => (string) $article->body,
                'audience' => (string) $article->audience,
                'requires_modules' => (string) ($article->requires_modules ?? ''),
                'published' => (bool) $article->published,
                'featured' => (bool) ($article->featured ?? false),
                'screenshot' => (string) ($article->screenshot ?? ''),
                'screenshot_alt' => (string) ($article->screenshot_alt ?? ''),
                'screenshot_caption' => (string) ($article->screenshot_caption ?? ''),
                'screenshot_source' => (string) ($article->screenshot_source ?? ''),
                'screenshot_source_url' => (string) ($article->screenshot_source_url ?? ''),
                'resource_links' => $this->repository()->resourceLinks($article),
                'block_order' => (int) $article->block_order,
            ])
            ->values()
            ->all();

        $payload = [
            'schema' => 'potts-help-centre-language-pack-v1',
            'module_version' => self::VERSION,
            'tree' => $tree->name(),
            'language' => $language,
            'articles' => $articles,
        ];
        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = 'potts-help-centre-' . strtolower(str_replace('-', '_', $language)) . '.json';

        return new Response(200, [
            'Content-Type' => 'application/json; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'X-Content-Type-Options' => 'nosniff',
        ], is_string($json) ? $json : '{}');
    }

    public function postAdminLanguageImportAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->assertAdmin();
        $tree = Validator::attributes($request)->tree();
        $decoded = json_decode(Validator::parsedBody($request)->string('language_pack', ''), true);

        if (!is_array($decoded) || ($decoded['schema'] ?? '') !== 'potts-help-centre-language-pack-v1' || !is_array($decoded['articles'] ?? null)) {
            FlashMessages::addMessage(I18N::translate('The language pack is not valid.'), 'danger');

            return redirect(route('module', ['module' => $this->name(), 'action' => 'Admin', 'tree' => $tree->name()]));
        }

        $packLanguage = $this->repository()->normaliseLanguage((string) ($decoded['language'] ?? HelpRepository::DEFAULT_LANGUAGE));
        $existing = $this->repository()->articles($tree, true);
        $added = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($decoded['articles'] as $item) {
            if (!is_array($item)) {
                ++$skipped;
                continue;
            }

            $title = trim(strip_tags((string) ($item['title'] ?? '')));
            $language = $this->repository()->normaliseLanguage((string) ($item['language'] ?? $packLanguage));
            $translationKey = trim((string) ($item['translation_key'] ?? $item['slug'] ?? $title));
            if ($title === '' || $translationKey === '') {
                ++$skipped;
                continue;
            }
            $normalisedTranslationKey = $this->repository()->normaliseTranslationKey($translationKey);

            $matching = $existing->first(static fn (object $article): bool =>
                (string) ($article->language ?? HelpRepository::DEFAULT_LANGUAGE) === $language
                && (string) ($article->translation_key ?? $article->slug) === $normalisedTranslationKey
            );
            $blockId = $matching === null ? 0 : (int) $matching->block_id;
            $slug = trim((string) ($item['slug'] ?? ''));
            if ($slug === '') {
                $slug = $translationKey . '-' . strtolower(str_replace('-', '_', $language));
            }

            $this->repository()->save($tree, [
                'title' => $title,
                'slug' => $slug,
                'translation_key' => $translationKey,
                'language' => $language,
                'category' => (string) ($item['category'] ?? 'getting-started'),
                'summary' => trim(strip_tags((string) ($item['summary'] ?? ''))),
                'body' => $this->htmlService()->sanitize((string) ($item['body'] ?? '')),
                'audience' => (string) ($item['audience'] ?? HelpRepository::AUDIENCE_MEMBERS),
                'requires_modules' => $item['requires_modules'] ?? '',
                'published' => !empty($item['published']),
                'featured' => !empty($item['featured']),
                'screenshot' => (string) ($item['screenshot'] ?? ''),
                'screenshot_alt' => (string) ($item['screenshot_alt'] ?? ''),
                'screenshot_caption' => (string) ($item['screenshot_caption'] ?? ''),
                'screenshot_source' => (string) ($item['screenshot_source'] ?? ''),
                'screenshot_source_url' => (string) ($item['screenshot_source_url'] ?? ''),
                'resource_links' => is_array($item['resource_links'] ?? null) ? $item['resource_links'] : [],
                'block_order' => max(1, (int) ($item['block_order'] ?? $this->repository()->nextOrder($tree))),
            ], $blockId);

            if ($blockId > 0) {
                ++$updated;
            } else {
                ++$added;
            }
            $existing = $this->repository()->articles($tree, true);
        }

        FlashMessages::addMessage(
            I18N::translate('%s translated articles were added, %s were updated and %s were skipped.', (string) $added, (string) $updated, (string) $skipped),
            'success'
        );

        return redirect(route('module', ['module' => $this->name(), 'action' => 'Admin', 'tree' => $tree->name()]));
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
                'featured' => false,
                'screenshot' => '',
                'screenshot_alt' => '',
                'screenshot_caption' => '',
                'screenshot_source' => '',
                'screenshot_source_url' => '',
                'language' => HelpRepository::DEFAULT_LANGUAGE,
                'translation_key' => '',
                'resource_links' => '[]',
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
            'screenshotUrl' => $this->articleScreenshotUrl($article),
            'translationArticles' => $this->repository()->articles($tree, true),
            'resourceLinksText' => $this->resourceLinksToText($this->repository()->resourceLinks($article)),
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
        $resourceLinks = $this->parseResourceLinksText(Validator::parsedBody($request)->string('resource_links', ''));

        $this->repository()->save($tree, [
            'title' => $title,
            'slug' => Validator::parsedBody($request)->string('slug', $title),
            'category' => $category,
            'summary' => $summary,
            'body' => $body,
            'audience' => $audience,
            'requires_modules' => $requiresModules,
            'published' => Validator::parsedBody($request)->boolean('published', false),
            'featured' => Validator::parsedBody($request)->boolean('featured', false),
            'screenshot' => Validator::parsedBody($request)->string('screenshot', ''),
            'screenshot_alt' => Validator::parsedBody($request)->string('screenshot_alt', ''),
            'screenshot_caption' => Validator::parsedBody($request)->string('screenshot_caption', ''),
            'screenshot_source' => Validator::parsedBody($request)->string('screenshot_source', ''),
            'screenshot_source_url' => Validator::parsedBody($request)->string('screenshot_source_url', ''),
            'language' => Validator::parsedBody($request)->string('language', HelpRepository::DEFAULT_LANGUAGE),
            'translation_key' => Validator::parsedBody($request)->string('translation_key', Validator::parsedBody($request)->string('slug', $title)),
            'resource_links' => $resourceLinks,
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
            'title' => I18N::translate('Member Help Centre'),
            'eyebrow' => I18N::translate('Webtrees editing and contribution guide'),
            'intro' => I18N::translate('Use the correct webtrees tabs to add people, relationships, facts, events, media and sources, then understand how those records feed Biography and other optional modules.'),
            'search_placeholder' => I18N::translate('Search for Families, Facts and events, Biography, photos…'),
        ];
    }

    /** @param array<string,array{title:string,description:string,group:string}> $categories
     *  @return Collection<int,object>
     */
    private function searchArticles(Collection $articles, string $query, array $categories): Collection
    {
        $phrase = $this->normaliseSearchText($query);
        $terms = array_values(array_filter(preg_split('/\s+/u', $phrase) ?: []));
        if ($terms === []) {
            return $articles;
        }

        return $articles
            ->filter(function (object $article) use ($terms, $categories): bool {
                $categoryTitle = (string) ($categories[$article->category]['title'] ?? '');
                $haystack = $this->normaliseSearchText(
                    $article->title . ' ' . $article->summary . ' ' . $categoryTitle . ' ' . strip_tags($article->body)
                );

                foreach ($terms as $term) {
                    if (!str_contains($haystack, $term)) {
                        return false;
                    }
                }

                return true;
            })
            ->sortByDesc(function (object $article) use ($phrase, $terms, $categories): int {
                $title = $this->normaliseSearchText((string) $article->title);
                $summary = $this->normaliseSearchText((string) $article->summary);
                $category = $this->normaliseSearchText((string) ($categories[$article->category]['title'] ?? ''));
                $body = $this->normaliseSearchText(strip_tags((string) $article->body));
                $score = 0;

                if ($phrase !== '' && str_contains($title, $phrase)) {
                    $score += 30;
                }
                if ($phrase !== '' && str_contains($summary, $phrase)) {
                    $score += 15;
                }

                foreach ($terms as $term) {
                    $score += str_contains($title, $term) ? 8 : 0;
                    $score += str_contains($summary, $term) ? 4 : 0;
                    $score += str_contains($category, $term) ? 3 : 0;
                    $score += str_contains($body, $term) ? 1 : 0;
                }

                return $score;
            })
            ->values();
    }

    private function normaliseSearchText(string $value): string
    {
        $value = mb_strtolower(strip_tags($value));
        $value = preg_replace('/[^\p{L}\p{N}]+/u', ' ', $value) ?? '';

        return trim($value);
    }

    /** @return Collection<int,object> */
    private function featuredArticles(Collection $articles, string $audience): Collection
    {
        $limit = $audience === HelpRepository::AUDIENCE_VISITORS ? 4 : 6;

        return $articles
            ->filter(static fn (object $article): bool => (bool) ($article->featured ?? false))
            ->take($limit)
            ->values();
    }

    private function ensureFeaturedUpgrade(Tree $tree): void
    {
        $preference = 'featured_upgrade_' . $tree->id();
        if ($this->getPreference($preference, '0') === '1') {
            return;
        }

        $this->repository()->seedFeaturedDefaults($tree);
        $this->setPreference($preference, '1');
    }

    private function ensureRc2ContentUpgrade(Tree $tree): void
    {
        $preference = 'content_upgrade_100_rc2_' . $tree->id();
        if ($this->getPreference($preference, '0') === '1') {
            return;
        }

        $this->repository()->seedRc2Enhancements($tree);
        $this->setPreference($preference, '1');
    }

    private function ensureScreenshotUpgrade(Tree $tree): void
    {
        $preference = 'screenshot_upgrade_100_rc2_' . $tree->id();
        if ($this->getPreference($preference, '0') === '1') {
            return;
        }

        $this->repository()->seedBundledScreenshots($tree);
        $this->setPreference($preference, '1');
    }

    private function articleScreenshotUrl(object $article): string
    {
        $value = trim((string) ($article->screenshot ?? ''));
        if ($value === '') {
            return '';
        }

        if (!str_starts_with($value, 'module://')) {
            return str_starts_with(strtolower($value), 'https://') ? $value : '';
        }

        $file = preg_replace('/[^a-zA-Z0-9._-]/', '', substr($value, 9)) ?? '';
        if ($file === '') {
            return '';
        }

        $path = $this->resourcesFolder() . 'screenshots/' . $file;
        $extension = strtolower((string) pathinfo($path, PATHINFO_EXTENSION));
        if (!is_file($path) || !in_array($extension, ['png', 'jpg', 'jpeg', 'webp'], true)) {
            return '';
        }

        $mime = match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            default => 'image/png',
        };
        $contents = file_get_contents($path);

        return is_string($contents) ? 'data:' . $mime . ';base64,' . base64_encode($contents) : '';
    }

    private function readingTime(string $body): int
    {
        $wordCount = str_word_count(strip_tags($body));

        return max(1, (int) ceil($wordCount / 220));
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
            $this->repository()->articlesForAudience($tree, $audience, false, I18N::languageTag()),
            $this->companionModuleStatus()
        )->keyBy('translation_key');

        $definitions = $this->contextualDefinitions($audience);
        $links = [];

        foreach ($definitions as $context => $definition) {
            $translationKey = $definition['slug'];
            if (!$articles->has($translationKey)) {
                continue;
            }

            $article = $articles->get($translationKey);
            $links[$context] = [
                'url' => route('module', [
                    'module' => $this->name(),
                    'action' => 'Article',
                    'tree' => $tree->name(),
                    'slug' => $article->slug,
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

    /** @return list<array{label:string,url:string}> */
    private function officialResources(): array
    {
        return [
            ['label' => I18N::translate('Official webtrees user documentation'), 'url' => 'https://webtrees.net/user/'],
            ['label' => I18N::translate('Official webtrees frequently asked questions'), 'url' => 'https://webtrees.net/faq/'],
            ['label' => I18N::translate('webtrees community forum'), 'url' => 'https://webtrees.net/forum/'],
        ];
    }

    private function contactUrl(Tree $tree, object $article): string
    {
        $contacts = Registry::container()->get(MessageService::class)->validContacts($tree);
        $contact = $contacts[0] ?? null;
        if ($contact === null) {
            return '';
        }

        $articleUrl = route('module', [
            'module' => $this->name(),
            'action' => 'Article',
            'tree' => $tree->name(),
            'slug' => $article->slug,
        ]);
        $body = I18N::translate(
            "I need help with the guide “%s”.\n\nPerson or record involved:\nWhat I was trying to do:\nWhat happened:\n\nPlease include a page link or screenshot where useful. Do not include passwords or highly sensitive personal information.",
            (string) $article->title
        );

        return route(ContactPage::class, [
            'tree' => $tree->name(),
            'to' => $contact->userName(),
            'subject' => I18N::translate('Help Centre question: %s', (string) $article->title),
            'body' => $body,
            'url' => $articleUrl,
        ]);
    }

    /** @return list<array{label:string,url:string}> */
    private function parseResourceLinksText(string $value): array
    {
        $links = [];
        foreach (preg_split('/\R/u', $value) ?: [] as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            [$label, $url] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');
            if ($label !== '' && filter_var($url, FILTER_VALIDATE_URL) && str_starts_with(strtolower($url), 'https://')) {
                $links[] = ['label' => strip_tags($label), 'url' => $url];
            }
        }

        return $links;
    }

    /** @param list<array{label:string,url:string}> $links */
    private function resourceLinksToText(array $links): string
    {
        return implode("\n", array_map(
            static fn (array $link): string => $link['label'] . ' | ' . $link['url'],
            $links
        ));
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
        return 'https://github.com/PottsNet/potts-help-centre/issues';
    }

    public function customModuleLatestVersionUrl(): string
    {
        return 'https://raw.githubusercontent.com/PottsNet/potts-help-centre/main/latest-version.txt';
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
