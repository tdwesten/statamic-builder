<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use ReflectionClass;
use Statamic\Facades\Fieldset as FieldsetFacade;
use Statamic\Http\Controllers\CP\Fields\FieldsetController as StatamicFieldsetController;

class FieldsetController extends StatamicFieldsetController
{
    public function edit($fieldset)
    {
        $builderFieldset = FieldsetFacade::findFieldset($fieldset);

        if ($builderFieldset) {
            $reflection = new ReflectionClass($builderFieldset);

            return view('statamic-builder::not-editable', [
                'type' => 'Fieldset',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => $reflection->getFileName(),
            ]);
        }

        return parent::edit($fieldset);
    }
}
