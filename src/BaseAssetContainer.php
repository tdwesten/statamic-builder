<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\AssetContainer as StatamicAssetContainer;

abstract class BaseAssetContainer
{
    abstract public static function handle(): string;

    public function title(): string
    {
        return (string) \Statamic\Support\Str::of(static::handle())->title()->replace('_', ' ');
    }

    public function disk(): string
    {
        return config('filesystems.default');
    }

    public function searchIndex(): ?string
    {
        return null;
    }

    public function register()
    {
        $container = StatamicAssetContainer::make($this->handle())
            ->title($this->title())
            ->disk($this->disk())
            ->searchIndex($this->searchIndex());

        return $container;
    }
}
