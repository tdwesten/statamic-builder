<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionClass;
use Statamic\Http\Controllers\CP\Collections\CollectionsController as StatamicCollectionsController;
use Tdwesten\StatamicBuilder\Repositories\CollectionRepository;

class CollectionsController extends StatamicCollectionsController
{
    protected $request;

    protected $collectionRepository;

    public function __construct(Request $request, CollectionRepository $collectionRepository)
    {
        $this->request = $request;

        $this->collectionRepository = $collectionRepository;
    }

    public function edit($collection)
    {
        $builderCollection = $this->collectionRepository->getCollectionByHandle($collection->handle());

        if ($builderCollection) {
            $reflection = new ReflectionClass($builderCollection);

            return view('statamic-builder::not-editable', [
                'type' => 'Collection',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $reflection->getFileName(),
            ]);
        }

        return parent::edit($collection);
    }
}
