<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController as StatamicTaxonomyBlueprintsController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class TaxonomyBlueprintsController extends StatamicTaxonomyBlueprintsController
{
    public function edit($taxonomy, $blueprint)
    {
        $termBlueprint = $taxonomy->termBlueprint($blueprint);

        $builderBlueprint = BlueprintRepository::findBlueprint($termBlueprint->namespace(), $termBlueprint->handle());

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath($termBlueprint->namespace(), $termBlueprint->handle());

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit($taxonomy, $blueprint);
    }
}
