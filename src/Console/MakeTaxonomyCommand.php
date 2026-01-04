<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeTaxonomyCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:taxonomy';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder Taxonomy';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Taxonomy';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/Taxonomy.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Taxonomies';
    }
}
