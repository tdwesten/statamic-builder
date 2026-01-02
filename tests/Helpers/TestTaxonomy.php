<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\BaseTaxonomy;

class TestTaxonomy extends BaseTaxonomy
{
    public static function handle(): string
    {
        return 'test_taxonomy';
    }

    public function title(): string
    {
        return 'Test Taxonomy';
    }

    public function sites(): array
    {
        return ['default'];
    }

    public function previewTargets(): array
    {
        return [];
    }

    public function termTemplate(): ?string
    {
        return null;
    }

    public function layout(): ?string
    {
        return null;
    }

    public function template(): ?string
    {
        return null;
    }

    public function collections(): array
    {
        return [];
    }
}
