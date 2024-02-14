<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Fields\ManagesBlueprints;
use Statamic\Http\Controllers\CP\Globals\GlobalsBlueprintController as StatamicGlobalsBlueprintController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class GlobalsBlueprintsController extends StatamicGlobalsBlueprintController
{
    use ManagesBlueprints;

    public function edit($blueprint)
    {
        $builderBlueprint = BlueprintRepository::findBlueprint('globals', $blueprint);

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath('globals', $blueprint);

            return view('statamic-builder::not-editable', [
                'blueprintPath' => $blueprintPath,
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
            ]);
        }

        return parent::edit($blueprint);
    }
}
