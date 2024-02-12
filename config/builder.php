<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Register Blueprints
    |--------------------------------------------------------------------------
    |
    | Here you can register the blueprints that you want to use in your
    | Statamic site.
    |
    */
    'blueprints' => [
        /*
        |--------------------------------------------------------------------------
        | Collection Blueprints
        |--------------------------------------------------------------------------
        |
        | Here you can register the blueprints that you want to use for your
        | collections.
        |
        */
        'collections.articles' => [
            // 'article' => App\Blueprints\ArticleBlueprint::class,
        ],
        'taxonomies.tags' => [
            // 'tag' => App\Blueprints\TagBlueprint::class,
        ],
        'globals' => [
            // 'footer' => App\Blueprints\SiteBlueprint::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Fieldsets
    |--------------------------------------------------------------------------
    |
    | Here you can register the fieldsets that you want to use in your
    | Statamic site.
    |
    */
    'fieldsets' => [
        /*
        |--------------------------------------------------------------------------
        | Collection Fieldsets
        |--------------------------------------------------------------------------
        |
        | Here you can register the fieldsets that you want to use for your
        | collections.
        |
        */
        [
            // \App\Fieldsets\LogoWithIntroductionFieldset::class,
        ],
    ],
];
