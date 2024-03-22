<?php

use Tests\Helpers\TestCollection;

test('Has a title', function () {
    $collection = new TestCollection();

    expect($collection->title())->toBe(
        'Shows'
    );
});
