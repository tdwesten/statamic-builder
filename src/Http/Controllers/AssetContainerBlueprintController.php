<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Assets\AssetContainerBlueprintController as StatamicAssetContainerBlueprintController;
use Tdwesten\StatamicBuilder\Repositories\BlueprintRepository;

class AssetContainerBlueprintController extends StatamicAssetContainerBlueprintController
{
    public function edit($container)
    {
        $blueprint = $container->blueprint();

        $builderBlueprint = BlueprintRepository::findBlueprint('assets', $blueprint->handle());

        if ($builderBlueprint) {
            $blueprintPath = BlueprintRepository::findBlueprintPath('assets', $blueprint->handle());

            return view('statamic-builder::not-editable', [
                'type' => 'Blueprint',
                'isLocal' => boolval(config('app.env') === 'local'),
                'filePath' => $blueprintPath,
            ]);
        }

        return parent::edit($container);
    }
}
