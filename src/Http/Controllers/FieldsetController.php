<?php

namespace Tdwesten\StatamicBuilder\Http\Controllers;

use Statamic\Facades\Fieldset as FieldsetFacade;
use Statamic\Http\Controllers\CP\Fields\FieldsetController as StatamicFieldsetController;

class FieldsetController extends StatamicFieldsetController
{
    public function edit($fieldset)
    {
        $builderFieldset = FieldsetFacade::findFieldset($fieldset);

        if ($builderFieldset) {
            return view('statamic-builder::not-editable', [
                'type' => 'Fieldset',
                'isLocal' => config('app.env') === 'local' || config('app.env') === 'development',
                'filePath' => null,
            ]);
        }

        return parent::edit($fieldset);
    }
}
