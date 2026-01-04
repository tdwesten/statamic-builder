<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Http\Controllers\CP\Assets\AssetContainersController as StatamicAssetContainersController;
use Tdwesten\StatamicBuilder\Repositories\AssetContainerRepository;

class AssetContainersController extends StatamicAssetContainersController
{
    public function edit($container)
    {
        /** @var AssetContainerRepository */
        $assetContainerRepository = app(\Statamic\Contracts\Assets\AssetContainerRepository::class);

        $builderContainer = $assetContainerRepository->getAssetContainerByHandle($container->handle());

        if ($builderContainer) {
            $reflectionClass = new \ReflectionClass($builderContainer);
            $filePath = $reflectionClass->getFileName();

            return view('statamic-builder::not-editable', [
                'type' => 'Asset Container',
                'isLocal' => boolval(config('app.env') === 'local'),
                'filePath' => $filePath,
            ]);
        }

        return parent::edit($container);
    }
}
