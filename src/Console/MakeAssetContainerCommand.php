<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeAssetContainerCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:asset-container';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder Asset Container';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Asset Container';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/AssetContainer.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\AssetContainers';
    }
}
