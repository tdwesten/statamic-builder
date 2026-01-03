<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\BaseAssetContainer;

class TestAssetContainer extends BaseAssetContainer
{
    public static function handle(): string
    {
        return 'main_assets';
    }

    public function title(): string
    {
        return 'Main Assets';
    }

    public function disk(): string
    {
        return 'assets';
    }
}
