<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeTaxonomyCommand extends BaseGeneratorCommand
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
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }

        if (! config('statamic.builder.auto_registration', false)) {
            $this->info('Remember to register your new Taxonomy in config/statamic/builder.php');
        }
    }

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
    protected function getNameInput()
    {
        $input = trim($this->argument('name'));

        return \Illuminate\Support\Str::studly($input);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Taxonomies';
    }
}
