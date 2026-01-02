<?php

use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('Section can be rendered', function () {
    $section = Section::make('General', [
        Text::make('title')->displayName('Title'),
    ]);

    $array = $section->toArray();

    expect($array['display'])->toBe('General');
    expect($array['fields'][0]['handle'])->toBe('title');
});
