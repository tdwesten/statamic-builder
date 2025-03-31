<?php

use Statamic\Facades\GlobalSet;
use Tests\TestCase;

pest()->extend(TestCase::class);
test('::find does not throw when no result is found', function (): void {
    GlobalSet::find('id-that-does-not-exist');
})->throwsNoExceptions();

test('::find returns null for nonexistent handles', function (): void {
    $nullset = GlobalSet::find('id-that-does-not-exist');

    expect($nullset)->toBeNull();
});
