<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\BaseNavigation;

class TestNavigation extends BaseNavigation
{
    public static function handle(): string
    {
        return 'test_navigation';
    }

    public function title(): string
    {
        return 'Test Navigation';
    }
}
