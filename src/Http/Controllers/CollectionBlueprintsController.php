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
        $blueprint = $collection->entryBlueprint($blueprint);

        $builderBlueprint = BlueprintRepository::findBlueprint($blueprint->namespace(), $blueprint->handle());

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath($blueprint->namespace(), $blueprint->handle());

            return view('statamic-builder::collections.blueprints.edit', [
                'collection' => $collection,
                'blueprint' => $blueprint,
                'blueprintPath' => $blueprintPath,
                'blueprintVueObject' => $this->toVueObject($blueprint),
            ]);
        }

        return view('statamic::collections.blueprints.edit', [
            'collection' => $collection,
            'blueprint' => $blueprint,
            'blueprintVueObject' => $this->toVueObject($blueprint),
        ]);
    }
}
