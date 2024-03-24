<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionClass;
use Statamic\Http\Controllers\CP\Globals\GlobalsController as StatamicGlobalsController;
use Tdwesten\StatamicBuilder\Repositories\GlobalRepository;

class GlobalsController extends StatamicGlobalsController
{
    protected $request;

    protected $globalsRepository;

    public function __construct(Request $request, GlobalRepository $globalRepository)
    {
        $this->request = $request;

        $this->globalsRepository = $globalRepository;
    }

    public function edit($set)
    {
        $builderCollection = $this->globalsRepository->getGlobalByHandle($set);

        if ($builderCollection) {
            $reflection = new ReflectionClass($builderCollection);

            return view('statamic-builder::not-editable', [
                'type' => 'Global Set',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $reflection->getFileName(),
            ]);
        }

        return parent::edit($set);
    }
}
