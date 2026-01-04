<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\Nav as StatamicNav;
use Statamic\Facades\Site;

abstract class BaseNavigation
{
    abstract public static function handle(): string;

    public function title(): string
    {
        return (string) \Statamic\Support\Str::of(static::handle())->title()->replace('_', ' ');
    }

    public function collections(): array
    {
        return [];
    }

    public function sites(): array
    {
        return [Site::default()->handle()];
    }

    public function expectsRoot(): bool
    {
        return false;
    }

    public function maxDepth(): ?int
    {
        return null;
    }

    public function register()
    {
        /** @var \Statamic\Structures\Nav */
        $nav = StatamicNav::make($this->handle())
            ->title($this->title())
            ->collections($this->collections())
            ->maxDepth($this->maxDepth())
            ->expectsRoot($this->expectsRoot());

        $nav->sites($this->sites());

        return $nav;
    }
}
