<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Fields\ManagesBlueprints;
use Statamic\Http\Controllers\CP\Globals\GlobalsBlueprintController as StatamicGlobalsBlueprintController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class GlobalesBlueprintsController extends StatamicGlobalsBlueprintController
{
    use ManagesBlueprints;

    public function edit($blueprint)
    {
        $builderBlueprint = BlueprintRepository::findBlueprint('globals', $blueprint);

        if ($builderBlueprint) {
            return view('statamic-builder::globals.blueprints.edit', []);
        }

        parent::edit($blueprint);
    }
}
