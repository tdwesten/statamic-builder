<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection as IlluminateCollection;
use Statamic\Stache\Repositories\TaxonomyRepository as StatamicTaxonomyRepository;
use Statamic\Stache\Stache;
use Statamic\Taxonomies\Taxonomy;
use Tdwesten\StatamicBuilder\BaseTaxonomy;

class TaxonomyRepository extends StatamicTaxonomyRepository
{
    /**
     * @var IlluminateCollection
     */
    private $taxonomies;

    public function __construct(Stache $stache)
    {
        parent::__construct($stache);

        $this->initializeTaxonomies();
    }

    private function initializeTaxonomies()
    {
        $taxonomies = collect(config('statamic.builder.taxonomies', []));

        $this->taxonomies = collect();

        $taxonomies->each(function (string $taxonomy): void {
            if (class_exists($taxonomy, true)) {
                $this->taxonomies->put($taxonomy::handle(), $taxonomy);
            }
        });
    }

    public function getTaxonomyByHandle($handle): ?BaseTaxonomy
    {
        $taxonomy = $this->taxonomies->get($handle, null);

        if ($taxonomy) {
            return new $taxonomy;
        }

        return null;
    }

    public function all(): IlluminateCollection
    {
        $keys = $this->store->paths()->keys();

        // add custom taxonomies
        $keys = $this->taxonomies->keys()->merge($keys);

        return $this->store->getItems($keys, $this->taxonomies);
    }

    public function findByHandle($handle): ?Taxonomy
    {
        $collection = $this->taxonomies->get($handle);

        if ($collection) {
            return (new $collection)->register();
        }

        return parent::findByHandle($handle);
    }
}
