<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Users\UserBlueprintController as StatamicUserBlueprintController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class UserBlueprintController extends StatamicUserBlueprintController
{
    public function edit()
    {
        $builderBlueprint = BlueprintRepository::findBlueprint(null, 'user');

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath(null, 'user');

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => boolval(config('app.env') === 'local'),
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit();
    }
}
