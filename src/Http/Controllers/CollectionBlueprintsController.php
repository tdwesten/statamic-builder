<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController as StatamicCollectionBlueprintsController;
use Statamic\Http\Controllers\CP\Fields\ManagesBlueprints;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class CollectionBlueprintsController extends StatamicCollectionBlueprintsController
{
    use ManagesBlueprints;

    public function edit($collection, $blueprint)
    {
        $entryBlueprint = $collection->entryBlueprint($blueprint);

        $builderBlueprint = BlueprintRepository::findBlueprint($entryBlueprint->namespace(), $entryBlueprint->handle());

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath($entryBlueprint->namespace(), $entryBlueprint->handle());

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit($collection, $blueprint);
    }
}
