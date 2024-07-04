<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Navigation\NavigationController as StatamicNavigationController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class NavigationController extends StatamicNavigationController
{
    public function edit($navHandle)
    {
        $navBlueprint = BlueprintRepository::findBlueprintInNamespace('navigation', $navHandle);

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
