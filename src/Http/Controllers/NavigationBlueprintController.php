<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Navigation\NavigationBlueprintController as StatamicNavigationBlueprintController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class NavigationBlueprintController extends StatamicNavigationBlueprintController
{
    public function edit($navHandle)
    {
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
