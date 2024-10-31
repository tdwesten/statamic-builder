<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\BaseSite;

class TestSite extends BaseSite
{
    /**
     * Return the handle for the site
     *
     * Example: return 'default';
     */
    public function handle(): string
    {
        return 'blog';
    }

    /**
     * Return the handle for the site
     *
     * Example: return 'Default';
     */
    public function name(): string
    {
        return 'Blog';
    }

    /**
     * Return the base url for the site
     *
     * Example: return '/';
     */
    public function url(): string
    {
        return 'http://blog.test';
    }

    /**
     * Return the locale of the site
     *
     * Example: return '/';
     */
    public function locale(): string
    {
        return 'en_US';
    }

    /**
     * Return the array of extra attributes for the site
     *
     * Example: return ['foo' => 'bar'];
     */
    public function attributes(): array
    {
        return [
            'extra' => 'attributes',
        ];
    }
}
