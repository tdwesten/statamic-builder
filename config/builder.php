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
        | collections, taxonomies, and globals.
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
    | blueprints.
    |
    */
    'fieldsets' => [
        // \App\Fieldsets\LogoWithIntroductionFieldset::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Collections
    |--------------------------------------------------------------------------
    |
    | Here you can register the collections that you want to use in your
    | Statamic site.
    |
    */
    'collections' => [
        // App\Collections\Articles::class,
    ],
];
