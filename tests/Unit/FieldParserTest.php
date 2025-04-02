<?php

namespace Tests\Unit;

use Tdwesten\StatamicBuilder\Helpers\FieldParser;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tests\Helpers\TestFieldset;

test('it preserves field order when flattening mixed fields', function () {
    $fieldset = new TestFieldset('test_fieldset');
    $standaloneField1 = new Text('standalone_field_1');
    $standaloneField2 = new Text('standalone_field_2');

    $mixedFields = [
        $standaloneField1,
        $fieldset,
        $standaloneField2,
    ];

    $fields = FieldParser::parseMixedFieldsToFlatCollection($mixedFields);

    expect($fields[0]->toArray()['handle'])->toBe('standalone_field_1');
    expect($fields[1]->toArray()['handle'])->toBe('test_fieldset.title');
    expect($fields[2]->toArray()['handle'])->toBe('test_fieldset.description');
    expect($fields[3]->toArray()['handle'])->toBe('test_fieldset.link');
    expect($fields[4]->toArray()['handle'])->toBe('standalone_field_2');
});
