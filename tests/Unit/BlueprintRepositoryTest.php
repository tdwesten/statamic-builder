<?php

use Illuminate\Support\Facades\File;
use Statamic\Facades\Blueprint;

it('keeps the namespace of a blueprint in an addon namespace', function (): void {
    $directory = sys_get_temp_dir().'/statamic-builder-addon-blueprints';
    File::ensureDirectoryExists($directory);
    File::put($directory.'/redirect.yaml', "title: Redirect\n");

    Blueprint::addNamespace('my-addon', $directory);

    $blueprints = Blueprint::in('my-addon');

    expect($blueprints)->toHaveCount(1)
        ->and($blueprints->first()->namespace())->toBe('my-addon')
        ->and($blueprints->first()->handle())->toBe('redirect');

    File::deleteDirectory($directory);
});
