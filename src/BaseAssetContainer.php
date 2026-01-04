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

    public function allowUploads(): bool
    {
        return true;
    }

    public function allowMoving(): bool
    {
        return true;
    }

    public function allowRenaming(): bool
    {
        return true;
    }

    public function createFolders(): bool
    {
        return true;
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
            ->allowUploads($this->allowUploads())
            ->allowMoving($this->allowMoving())
            ->allowRenaming($this->allowRenaming())
            ->createFolders($this->createFolders())
            ->searchIndex($this->searchIndex());

        return $container;
    }
}
