<?php

use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('Tab can be rendered', function (): void {
    $tab = Tab::make('main', [
        Section::make('General', [
            Text::make('title')->displayName('Title'),
        ]),
    ])->displayName('Main');

    $array = $tab->toArray();

    expect($array['display'])->toBe('Main');
    expect($array['sections'][0]['display'])->toBe('General');
});
