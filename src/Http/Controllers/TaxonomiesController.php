<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionClass;
use Statamic\Http\Controllers\CP\Taxonomies\TaxonomiesController as StatamicTaxonomiesController;
use Tdwesten\StatamicBuilder\Repositories\TaxonomyRepository;

class TaxonomiesController extends StatamicTaxonomiesController
{
    protected $request;

    protected $taxonomyRepository;

    public function __construct(Request $request, TaxonomyRepository $taxonomyRepository)
    {
        $this->request = $request;

        $this->taxonomyRepository = $taxonomyRepository;
    }

    public function edit($taxonomy)
    {
        $builderCollection = $this->taxonomyRepository->getTaxonomyByHandle($taxonomy->handle());

        if ($builderCollection) {
            $reflection = new ReflectionClass($builderCollection);

            return view('statamic-builder::not-editable', [
                'type' => 'Taxonomy',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $reflection->getFileName(),
            ]);
        }

        return parent::edit($taxonomy);
    }
}
