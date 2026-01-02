<?php

namespace Tdwesten\StatamicBuilder\Stache\Stores;

use Illuminate\Support\Collection;
use Statamic\Stache\Stores\GlobalsStore as StatamicGlobalsStore;
use Tdwesten\StatamicBuilder\BaseGlobalSet;
use Tdwesten\StatamicBuilder\BaseTaxonomy;

class GlobalsStore extends StatamicGlobalsStore
{
    public function getItem($key, $globals = null)
    {
        /** @var Collection */
        $globals = $globals ?? collect([]);

        if ($globals->has($key)) {
            /** @var BaseTaxonomy */
            $globalSet = $globals->get($key);
            $globalSet = new $globalSet($key);

            if (! $globalSet instanceof BaseGlobalSet) {
                throw new \Exception("Collection [{$key}] must extend [Tdwesten\StatamicBuilder\BaseGlobalSet]");
            }

            $item = $globalSet->register();

            $this->cacheItem($item);

            return $item;
        }

        return parent::getItem($key);
    }

    public function getItems($keys, $globals = null)
    {
        $this->handleFileChanges();

        return collect($keys)->mapWithKeys(function ($key) use ($globals) {
            return [$key => $this->getItem($key, $globals)];
        });
    }
}
