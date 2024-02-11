<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\Blueprint;

class EmptyTestBlueprint extends Blueprint
{
    public $title = 'Test Blueprint';

    public $handle = 'test_blueprint';

    public $hidden = false;

    public function registerTabs(): array
    {
        return [];
    }
}
