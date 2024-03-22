<?php

namespace Tests\Helpers;

use Statamic\Facades\Site;
use Tdwesten\StatamicBuilder\BaseCollection;

class TestCollection extends BaseCollection
{
    /**
     * The title for the collection
     *
     * Example: return 'Blog';
     */
    public function title(): string
    {
        return 'Shows';
    }

    /**
     * The handle for the collection
     *
     * Example: return 'blog';
     */
    public static function handle(): string
    {
        return 'shows';
    }

    /**
     * The route for the collection
     *
     * Example: return '/blog/{slug}';
     *
     * Docs: https://statamic.dev/collections#routing
     */
    public function route(): ?string
    {
        return null;
    }

    /**
     * Generate a slug for the collection?
     *
     * Docs: https://statamic.dev/collections#slugs
     */
    public function slugs(): bool
    {
        return true;
    }

    /**
     * Return the title format for the collection
     *
     * Docs: https://statamic.dev/collections#titles
     */
    public function titleFormat(): null|string|array
    {
        return null;
    }

    /**
     * Return the mount for the collection
     *
     * Docs: https://statamic.dev/collections#mounting
     */
    public function mount(): ?string
    {
        return null;
    }

    /**
     * Use dates in the collection?
     *
     * Docs: ??
     */
    public function date(): bool
    {
        return false;
    }

    /**
     * Return the sites for the collection
     *
     * Example: return ['en', 'de'];
     *
     * Docs: https://statamic.dev/collections#sites
     */
    public function sites(): array
    {
        return Site::hasMultiple() ? [] : [Site::default()->handle()];
    }

    /**
     * Return the default publish state for the collection
     *
     * Example: return 'blog/show';
     */
    public function template(): ?string
    {
        return null;
    }

    /**
     * Return the default layout for the collection
     *
     * Example: return 'blog/layout';
     */
    public function layout(): ?string
    {
        return null;
    }

    /**
     * Return the default inject for the collection
     *
     * @docs https://statamic.dev/collections#inject
     */
    public function inject(): array
    {
        return [];
    }

    /**
     * Return the default search index for the collection
     *
     * @docs https://statamic.dev/search
     */
    public function searchIndex(): string
    {
        return 'search_index';
    }

    /**
     * Enable revisions for the collection?
     *
     * @docs https://statamic.dev/revisions
     */
    public function revisionsEnabled(): bool
    {
        return false;
    }

    /**
     * Return the default publish state for the collection
     *
     * Options are 'published' or 'draft'
     *
     * Example: return 'published';
     */
    public function defaultPublishState(): bool
    {
        return true;
    }

    /**
     * Origin behavior for the collection
     */
    public function originBehavior(): string
    {
        return 'select';
    }

    /**
     * Return the structure for the collection
     *
     * @example return [
     *    'root' => true,
     *    'slugs' => true,
     *    'max_depth' => 3,
     * ];
     *
     * @docs https://statamic.dev/structures
     */
    public function structure(): array
    {
        return [
            'root' => false,
            'slugs' => false,
            'max_depth' => null,
        ];
    }

    /**
     * Return the sort by for the collection
     *
     * @example return 'title';
     *
     * @docs https://statamic.dev/collections#default-sort-order-in-listings
     */
    public function sortBy(): ?string
    {
        return null;
    }

    /**
     * Return the sort direction for the collection
     *
     * @example return 'asc' / 'desc';
     *
     * @docs https://statamic.dev/collections#default-sort-order-in-listings
     */
    public function sortDir(): ?string
    {
        return null;
    }

    /**
     * Return the taxonomies for the collection
     *
     * @example return ['tags', 'categories'];
     *
     * @docs https://statamic.dev/collections#taxonomies
     */
    public function taxonomies(): array
    {
        return [];
    }

    /**
     * Propagate the collection?
     *
     * @docs https://statamic.dev/tips/localizing-entries#propagation
     */
    public function propagate(): ?bool
    {
        return null;
    }

    /**
     * Return the preview targets for the collection
     *
     * @example return [
     *   [
     *     'label' => 'Entry',
     *     'url' => '/blog/{slug}',
     *   ],
     *   [
     *     'label' => 'Index',
     *     'url' => '/blog',
     *   ],
     * ];
     *
     * @docs https://statamic.dev/live-preview#preview-targets
     */
    public function previewTargets(): array
    {
        return [];
    }

    /**
     * Return the autosave interval for the collection
     *
     * @example return true;
     * @example return 5000; // 5 seconds
     */
    public function autosave(): bool|int|null
    {
        return null;
    }

    /**
     * Return the future date behavior for the collection
     *
     * Possible values are 'public', 'unlisted', 'private'
     *
     * @example return 'public';
     *
     * @docs https://statamic.dev/collections#dates
     */
    public function futureDateBehavior(): ?string
    {
        return null;
    }

    /**
     * Return the past date behavior for the collection
     *
     * Possible values are 'public', 'unlisted', 'private'
     *
     * @example return 'public';
     */
    public function pastDateBehavior(): ?string
    {
        return null;
    }
}
