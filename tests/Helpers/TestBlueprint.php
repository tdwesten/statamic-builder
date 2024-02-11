<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\Blueprint;
use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

class TestBlueprint extends Blueprint
{
    public $title = 'Test Blueprint';

    public $handle = 'test_blueprint';

    public $hidden = false;

    public function registerTabs(): array
    {
        return [
            Tab::make('main', [
                Section::make('General', [
                    Text::make('title'),
                ]),
            ])->displayName('Main'),
        ];
    }
}
