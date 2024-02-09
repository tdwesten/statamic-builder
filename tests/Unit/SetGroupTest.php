<?php

use Tdwesten\StatamicBuilder\FieldTypes\Set;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

it('can render to a array', function () {
    $field = \Tdwesten\StatamicBuilder\FieldTypes\SetGroup::make('title', [
        Set::make('set_group_handel', [
            Text::make('text_veld')->displayName('Tekst Veld'),
        ])->icon('addon-boxes-stack')->instructions('set group instructies')->displayName('Set group'),
    ]);

    expect($field->toArray()['sets']['set_group_handel']['display'])->toBe('Set group');
});
