<?php

declare(strict_types=1);

namespace PottsMemberHelp;

use Fisharebest\Webtrees\DB;
use Fisharebest\Webtrees\Tree;
use Illuminate\Support\Collection;
use stdClass;

use function array_filter;
use function array_map;
use function array_unique;
use function array_values;
use function collect;
use function explode;
use function implode;
use function in_array;
use function is_array;
use function is_file;
use function max;
use function preg_replace;
use function property_exists;
use function sort;
use function strtolower;
use function strip_tags;
use function trim;

final class HelpRepository
{
    public const AUDIENCE_VISITORS = 'visitors';
    public const AUDIENCE_MEMBERS = 'members';
    public const AUDIENCE_EVERYONE = 'everyone';

    public function __construct(
        private readonly string $moduleName,
        private readonly string $defaultsFile
    ) {
    }

    /** @return array<string,array{title:string,description:string,group:string}> */
    public function categories(): array
    {
        return [
            'visitor-start' => [
                'title' => 'Using webtrees',
                'description' => 'Learn how this family-history website is organised and how to begin.',
                'group' => 'visitors',
            ],
            'searching-viewing' => [
                'title' => 'Searching and viewing',
                'description' => 'Find people and understand names, dates, places and records.',
                'group' => 'visitors',
            ],
            'individual-pages' => [
                'title' => 'Understanding a person’s page',
                'description' => 'Use Biography, Facts and events, Families and other individual-page tabs.',
                'group' => 'visitors',
            ],
            'charts-tools' => [
                'title' => 'Charts and family links',
                'description' => 'Explore ancestors, descendants, relationships and the interactive tree.',
                'group' => 'visitors',
            ],
            'optional-features' => [
                'title' => 'Biography and optional features',
                'description' => 'Understand relationship labels, historical context, age labels and display choices.',
                'group' => 'visitors',
            ],
            'privacy-accounts' => [
                'title' => 'Privacy and accounts',
                'description' => 'Understand living people, registration, sign-in access and responsible use.',
                'group' => 'visitors',
            ],
            'corrections-contact' => [
                'title' => 'Corrections and contact',
                'description' => 'Report an error, share information or contact the website administrator.',
                'group' => 'visitors',
            ],
            'getting-started' => [
                'title' => 'Editing in webtrees',
                'description' => 'Choose the correct tab, understand permissions and avoid common mistakes.',
                'group' => 'members',
            ],
            'people-families' => [
                'title' => 'People and families',
                'description' => 'Create people and connect parents, partners and children correctly.',
                'group' => 'members',
            ],
            'names' => [
                'title' => 'Names',
                'description' => 'Correct names and record maiden names, nicknames and known-as names.',
                'group' => 'members',
            ],
            'facts-events' => [
                'title' => 'Facts and events',
                'description' => 'Add and update dates, places, occupations, residences and family events.',
                'group' => 'members',
            ],
            'photos-documents' => [
                'title' => 'Photos and documents',
                'description' => 'Upload, describe and link photographs, certificates and other media.',
                'group' => 'members',
            ],
            'sources-research' => [
                'title' => 'Sources and research',
                'description' => 'Record evidence, citations, uncertainty and research notes.',
                'group' => 'members',
            ],
            'biography-content' => [
                'title' => 'Improving the Biography',
                'description' => 'Improve story wording, research notes and intelligent media placement.',
                'group' => 'members',
            ],
            'historical-context' => [
                'title' => 'Historical context',
                'description' => 'Understand and contribute sourced regional history without confusing it with personal events.',
                'group' => 'members',
            ],
            'display-options' => [
                'title' => 'Relationship and display options',
                'description' => 'Adjust relationship, close-relative, historical and age presentation.',
                'group' => 'members',
            ],
            'privacy-good-practice' => [
                'title' => 'Privacy and good practice',
                'description' => 'Protect living people and contribute reliable, respectful family history.',
                'group' => 'members',
            ],
        ];
    }

    /** @return array<string,string> */
    public function audiences(): array
    {
        return [
            self::AUDIENCE_VISITORS => 'Visitors only',
            self::AUDIENCE_MEMBERS => 'Registered members only',
            self::AUDIENCE_EVERYONE => 'Everyone',
        ];
    }

    /** @return array<int,array<string,mixed>> */
    public function defaults(): array
    {
        $articles = is_file($this->defaultsFile) ? include $this->defaultsFile : [];

        return is_array($articles) ? array_values($articles) : [];
    }

    public function ensureSeeded(Tree $tree): void
    {
        if ($this->storedArticles($tree)->isNotEmpty()) {
            return;
        }

        foreach ($this->defaults() as $article) {
            $this->save($tree, $article, 0);
        }
    }

    public function missingDefaultCount(Tree $tree): int
    {
        $existingSlugs = $this->storedArticles($tree)
            ->pluck('slug')
            ->filter()
            ->all();

        return collect($this->defaults())
            ->filter(fn (array $article): bool => !in_array($this->normaliseSlug((string) ($article['slug'] ?? $article['title'] ?? '')), $existingSlugs, true))
            ->count();
    }

    public function seedMissingDefaults(Tree $tree): int
    {
        $existingSlugs = $this->storedArticles($tree)
            ->pluck('slug')
            ->filter()
            ->all();
        $added = 0;

        foreach ($this->defaults() as $article) {
            $slug = $this->normaliseSlug((string) ($article['slug'] ?? $article['title'] ?? ''));
            if (in_array($slug, $existingSlugs, true)) {
                continue;
            }

            $article['slug'] = $slug;
            $this->save($tree, $article, 0);
            $existingSlugs[] = $slug;
            ++$added;
        }

        return $added;
    }

    /**
     * Replace articles whose slugs match bundled starter articles and add any that are missing.
     * Custom articles with other slugs are preserved.
     *
     * @return array{added:int,updated:int}
     */
    public function replaceStarterArticles(Tree $tree): array
    {
        $existing = $this->storedArticles($tree)->keyBy('slug');
        $added = 0;
        $updated = 0;

        foreach ($this->defaults() as $article) {
            $slug = $this->normaliseSlug((string) ($article['slug'] ?? $article['title'] ?? ''));
            $article['slug'] = $slug;
            $stored = $existing->get($slug);

            if ($stored instanceof stdClass) {
                $this->save($tree, $article, (int) $stored->block_id);
                ++$updated;
            } else {
                $this->save($tree, $article, 0);
                ++$added;
            }
        }

        return ['added' => $added, 'updated' => $updated];
    }

    /** @return Collection<int,object> */
    public function articles(Tree $tree, bool $includeUnpublished = false): Collection
    {
        $stored = $this->storedArticles($tree);

        if ($stored->isEmpty()) {
            $stored = collect($this->defaults())->map(function (array $article, int $index): object {
                $row = (object) $article;
                $row->block_id = 0;
                $row->block_order = (int) ($article['block_order'] ?? $index + 1);
                $row->published = (bool) ($article['published'] ?? true);
                $row->audience = $this->normaliseAudience((string) ($article['audience'] ?? self::AUDIENCE_MEMBERS));
                $row->requires_modules = $this->normaliseModuleList($article['requires_modules'] ?? '');
                $row->feedback_yes = 0;
                $row->feedback_no = 0;
                $row->is_default = true;

                return $row;
            });
        }

        if (!$includeUnpublished) {
            $stored = $stored->filter(static fn (object $article): bool => $article->published === true);
        }

        return $stored
            ->sortBy([['block_order', 'asc'], ['title', 'asc']])
            ->values();
    }

    /** @return Collection<int,object> */
    public function articlesForAudience(Tree $tree, string $audience, bool $includeUnpublished = false): Collection
    {
        $audience = $this->normaliseAudience($audience);

        return $this->articles($tree, $includeUnpublished)
            ->filter(static fn (object $article): bool => $article->audience === self::AUDIENCE_EVERYONE || $article->audience === $audience)
            ->values();
    }

    public function findBySlug(Tree $tree, string $slug, bool $includeUnpublished = false): object|null
    {
        return $this->articles($tree, $includeUnpublished)
            ->first(static fn (object $article): bool => $article->slug === $slug);
    }

    public function findById(Tree $tree, int $blockId): object|null
    {
        return $this->articles($tree, true)
            ->first(static fn (object $article): bool => $article->block_id === $blockId);
    }

    /** @param array<string,mixed> $data */
    public function save(Tree $tree, array $data, int $blockId = 0): int
    {
        $title = trim((string) ($data['title'] ?? ''));
        $slug = $this->normaliseSlug((string) ($data['slug'] ?? $title));
        $category = trim((string) ($data['category'] ?? 'getting-started'));
        $summary = trim((string) ($data['summary'] ?? ''));
        $body = trim((string) ($data['body'] ?? ''));
        $audience = $this->normaliseAudience((string) ($data['audience'] ?? self::AUDIENCE_MEMBERS));
        $requiresModules = $this->normaliseModuleList($data['requires_modules'] ?? '');
        $published = !empty($data['published']) ? '1' : '0';
        $blockOrder = max(1, (int) ($data['block_order'] ?? 1));

        if ($blockId > 0) {
            $owned = DB::table('block')
                ->where('block_id', '=', $blockId)
                ->where('module_name', '=', $this->moduleName)
                ->where('gedcom_id', '=', $tree->id())
                ->exists();

            if (!$owned) {
                $blockId = 0;
            }
        }

        if ($blockId === 0) {
            DB::table('block')->insert([
                'gedcom_id' => $tree->id(),
                'module_name' => $this->moduleName,
                'block_order' => $blockOrder,
            ]);
            $blockId = DB::lastInsertId();
        } else {
            DB::table('block')
                ->where('block_id', '=', $blockId)
                ->update(['block_order' => $blockOrder]);
        }

        $this->setSetting($blockId, 'title', $title);
        $this->setSetting($blockId, 'slug', $slug);
        $this->setSetting($blockId, 'category', $category);
        $this->setSetting($blockId, 'summary', $summary);
        $this->setSetting($blockId, 'body', $body);
        $this->setSetting($blockId, 'audience', $audience);
        $this->setSetting($blockId, 'requires_modules', $requiresModules);
        $this->setSetting($blockId, 'published', $published);

        return $blockId;
    }

    public function recordFeedback(Tree $tree, string $slug, bool $helpful): bool
    {
        $this->ensureSeeded($tree);
        $article = $this->storedArticles($tree)
            ->first(static fn (object $item): bool => $item->slug === $slug);

        if (!$article instanceof stdClass) {
            return false;
        }

        $setting = $helpful ? 'feedback_yes' : 'feedback_no';
        $count = max(0, (int) ($article->{$setting} ?? 0)) + 1;
        $this->setSetting((int) $article->block_id, $setting, (string) $count);

        return true;
    }

    public function delete(Tree $tree, int $blockId): void
    {
        $owned = DB::table('block')
            ->where('block_id', '=', $blockId)
            ->where('module_name', '=', $this->moduleName)
            ->where('gedcom_id', '=', $tree->id())
            ->exists();

        if (!$owned) {
            return;
        }

        DB::table('block_setting')->where('block_id', '=', $blockId)->delete();
        DB::table('block')->where('block_id', '=', $blockId)->delete();
    }

    public function nextOrder(Tree $tree): int
    {
        return 1 + (int) DB::table('block')
            ->where('module_name', '=', $this->moduleName)
            ->where('gedcom_id', '=', $tree->id())
            ->max('block_order');
    }

    /** @return Collection<int,object> */
    private function storedArticles(Tree $tree): Collection
    {
        $blocks = DB::table('block')
            ->where('module_name', '=', $this->moduleName)
            ->where('gedcom_id', '=', $tree->id())
            ->orderBy('block_order')
            ->get();

        if ($blocks->isEmpty()) {
            return collect();
        }

        $ids = $blocks->pluck('block_id')->map(static fn ($id): int => (int) $id)->all();
        $settings = DB::table('block_setting')
            ->whereIn('block_id', $ids)
            ->get()
            ->groupBy(static fn (object $row): int => (int) $row->block_id);

        return $blocks->map(function (object $block) use ($settings): object {
            $article = new stdClass();
            $article->block_id = (int) $block->block_id;
            $article->block_order = (int) $block->block_order;
            $article->title = '';
            $article->slug = '';
            $article->category = 'getting-started';
            $article->summary = '';
            $article->body = '';
            $article->audience = self::AUDIENCE_MEMBERS;
            $article->requires_modules = '';
            $article->published = true;
            $article->feedback_yes = 0;
            $article->feedback_no = 0;
            $article->is_default = false;

            foreach ($settings->get($article->block_id, collect()) as $setting) {
                $name = (string) $setting->setting_name;
                $value = (string) $setting->setting_value;

                if ($name === 'published') {
                    $article->published = $value === '1';
                } elseif ($name === 'feedback_yes' || $name === 'feedback_no') {
                    $article->{$name} = max(0, (int) $value);
                } elseif (property_exists($article, $name)) {
                    $article->{$name} = $value;
                }
            }

            $article->audience = $this->normaliseAudience((string) $article->audience);
            $article->requires_modules = $this->normaliseModuleList((string) $article->requires_modules);

            return $article;
        });
    }

    private function setSetting(int $blockId, string $name, string $value): void
    {
        DB::table('block_setting')
            ->where('block_id', '=', $blockId)
            ->where('setting_name', '=', $name)
            ->delete();

        DB::table('block_setting')->insert([
            'block_id' => $blockId,
            'setting_name' => $name,
            'setting_value' => $value,
        ]);
    }

    private function normaliseSlug(string $slug): string
    {
        $slug = strtolower(trim(strip_tags($slug)));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
        $slug = trim($slug, '-');

        return $slug !== '' ? $slug : 'help-article';
    }

    private function normaliseAudience(string $audience): string
    {
        return match ($audience) {
            self::AUDIENCE_VISITORS,
            self::AUDIENCE_EVERYONE => $audience,
            default => self::AUDIENCE_MEMBERS,
        };
    }

    private function normaliseModuleList(mixed $modules): string
    {
        if (is_array($modules)) {
            $items = $modules;
        } else {
            $items = explode(',', (string) $modules);
        }

        $items = array_map(static fn (mixed $module): string => trim((string) $module), $items);
        $items = array_filter($items, static fn (string $module): bool => $module !== '');
        $items = array_values(array_unique($items));
        sort($items);

        return implode(',', $items);
    }
}
