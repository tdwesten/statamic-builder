<?php

use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tests\Helpers\TestBlueprint;

test('Has a title', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');

    expect($blueprint->toArray()['title'])->toBe(
        'Test Blueprint'
    );
});

it('can be set to hidden', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');
    $blueprint->hidden(true);

    expect($blueprint->toArray()['hide'])->toBe(true);
});

test('Tabs are renderd', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');

    $expected = [
        'title' => 'Test Blueprint',
        'hide' => false,
        'tabs' => [
            'main' => [
                'display' => 'Main',
                'sections' => [
                    [
                        'display' => 'General',
                        'fields' => [
                            [
                                'handle' => 'title',
                                'field' => [
                                    'antlers' => false,
                                    'display' => 'Title',
                                    'duplicate' => true,
                                    'hide_display' => false,
                                    'input_type' => 'text',
                                    'instructions_position' => 'above',
                                    'listable' => 'hidden',
                                    'localizable' => false,
                                    'replicator_preview' => true,
                                    'type' => 'text',
                                    'visibility' => 'visible',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    expect($blueprint->toArray())->toBe($expected);
});

it('throws an exception when adding a field to a tab', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');
    $blueprint
        ->title('School')
        ->addTab(Tab::make('main', [
            Text::make('name')->displayName('Name'),
        ]));

    $blueprint->toArray();
})->throws(BlueprintRenderException::class, 'Only sections are allowed in tabs');

test('you can set a title', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');
    $blueprint->title('School');

    expect($blueprint->toArray()['title'])->toBe('School');
});

test('you can get the handle', function (): void {
    $blueprint = TestBlueprint::make('test_blueprint');

    expect($blueprint->getHandle())->toBe('test_blueprint');
});

test('base blueprint static handle returns empty string by default', function (): void {
    $blueprint = new class extends \Tdwesten\StatamicBuilder\Blueprint
    {
        public function registerTabs(): array
        {
            return [];
        }
    };

    expect($blueprint::handle())->toBe('');
});

test('static blueprintNamespace returns empty string by default', function (): void {
    $blueprint = new class extends \Tdwesten\StatamicBuilder\Blueprint
    {
        public function registerTabs(): array
        {
            return [];
        }
    };

    expect($blueprint::blueprintNamespace())->toBe('');
});

test('blueprint with empty tabs returns empty array', function (): void {
    $blueprint = new class extends \Tdwesten\StatamicBuilder\Blueprint
    {
        public function registerTabs(): array
        {
            return [];
        }
    };

    expect($blueprint->toArray()['tabs'])->toBe([]);
});

test('blueprint throws exception when non-tab field is in registerTabs', function (): void {
    $blueprint = new class extends \Tdwesten\StatamicBuilder\Blueprint
    {
        public function registerTabs(): array
        {
            return [
                \Tdwesten\StatamicBuilder\FieldTypes\Text::make('title'),
            ];
        }
    };

    $blueprint->toArray();
})->throws(\Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException::class, 'Only tabs are allowed in the register function of a blueprint');
