<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\BaseGlobalSet;

class TestGlobalSet extends BaseGlobalSet
{
    public static function handle(): string
    {
        return 'test_global';
    }

    public function title(): string
    {
        return 'Test Global Set';
    }

    public function sites(): array
    {
        return ['default'];
    }
}
