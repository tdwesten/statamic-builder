<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\Taxonomy as StatamicTaxonomy;

abstract class BaseTaxonomy
{
    abstract public static function handle(): string;

    abstract public function title(): string;

    abstract public function sites(): array;

    abstract public function previewTargets(): array;

    abstract public function termTemplate(): ?string;

    abstract public function layout(): ?string;

    abstract public function template(): ?string;

    abstract public function collections(): array;

    public function register()
    {
        /** @var StatamicTaxonomy */
        $taxonomy = StatamicTaxonomy::make($this->handle())
            ->title($this->title())
            ->sites($this->sites())
            ->previewTargets($this->previewTargets())
            ->termTemplate($this->termTemplate())
            ->layout($this->layout())
            ->template($this->template());

        return $taxonomy;
    }
}
