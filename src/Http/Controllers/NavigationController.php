<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Navigation\NavigationController as StatamicNavigationController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;
use Tdwesten\StatamicBuilder\Repositories\NavigationRepository;

class NavigationController extends StatamicNavigationController
{
    public function edit($navHandle)
    {
        /** @var NavigationRepository */
        $navigationRepository = app(\Statamic\Contracts\Structures\NavigationRepository::class);

        $navigation = $navigationRepository->getNavigationByHandle($navHandle);

        if ($navigation) {
            $reflectionClass = new \ReflectionClass($navigation);
            $filePath = $reflectionClass->getFileName();

            return view('statamic-builder::not-editable', [
                'type' => 'Navigation',
                'isLocal' => boolval(config('app.env') === 'local'),
                'filePath' => $filePath,
            ]);
        }

        $navBlueprint = BlueprintRepository::findBlueprint('navigation', $navHandle);

        if ($navBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath('navigation', $navHandle);

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => boolval(config('app.env') === 'local'),
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit($navHandle);
    }
}
