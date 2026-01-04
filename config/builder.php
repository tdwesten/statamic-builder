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
        'navigation' => [
            // 'main' => App\Blueprints\MainNavigationBlueprint::class,
        ],
        'assets' => [
            // 'assets' => App\Blueprints\AssetsContainerBlueprint::class,
        ],
        'user' => null,
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

    /*
    |--------------------------------------------------------------------------
    | Register Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you can register the taxonomies that you want to use in your
    | Statamic site.
    |
    */
    'taxonomies' => [
        // App\Taxonomies\Tags::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Globals
    |--------------------------------------------------------------------------
    |
    | Here you can register the globals that you want to use in your
    | Statamic site.
    |
    */
    'globals' => [
        // App\Globals\Footer::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Sites
    |--------------------------------------------------------------------------
    |
    | Here you can register the sites that you want to use in your
    | Statamic site.
    |
    */
    'sites' => [
        // App\Sites\Blog::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Asset Containers
    |--------------------------------------------------------------------------
    |
    | Here you can register the asset containers that you want to use in your
    | Statamic site.
    |
    */
    'asset_containers' => [
        // App\AssetContainers\Main::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Register Navigations
    |--------------------------------------------------------------------------
    |
    | Here you can register the navigations that you want to use in your
    | Statamic site.
    |
    */
    'navigations' => [
        // App\Navigations\Main::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto Registration
    |--------------------------------------------------------------------------
    |
    | Here you can enable auto registration of your blueprints, fieldsets,
    | collections, taxonomies, globals, sites, and navigations.
    |
    */
    'auto_registration' => false,

    /*
    |--------------------------------------------------------------------------
    | Auto Discovery Paths
    |--------------------------------------------------------------------------
    |
    | Here you can define the paths that will be used to auto discover your
    | blueprints, fieldsets, collections, taxonomies, globals, sites, and
    | navigations.
    |
    */
    'auto_discovery' => [
        'blueprints' => app_path('Blueprints'),
        'fieldsets' => app_path('Fieldsets'),
        'collections' => app_path('Collections'),
        'taxonomies' => app_path('Taxonomies'),
        'globals' => app_path('Globals'),
        'navigations' => app_path('Navigations'),
        'asset_containers' => app_path('AssetContainers'),
        'sites' => app_path('Sites'),
    ],
];
