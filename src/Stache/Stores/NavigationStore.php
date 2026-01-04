<?php

namespace Tdwesten\StatamicBuilder\Stache\Stores;

use Illuminate\Support\Collection;
use Statamic\Stache\Stores\NavigationStore as StatamicNavigationStore;
use Tdwesten\StatamicBuilder\BaseNavigation;

class NavigationStore extends StatamicNavigationStore
{
    public function getItem($key, $navigations = null)
    {
        /** @var Collection */
        $navigations = $navigations ?? collect([]);

        if ($navigations->has($key)) {
            /** @var BaseNavigation */
            $navigation = $navigations->get($key);
            $navigation = new $navigation;

            if (! $navigation instanceof BaseNavigation) {
                throw new \Exception("Navigation [{$key}] must extend [Tdwesten\StatamicBuilder\BaseNavigation]");
            }

            $item = $navigation->register();

            $this->cacheItem($item);

            return $item;
        }

        return parent::getItem($key);
    }

    public function getItems($keys, $navigations = null)
    {
        $this->handleFileChanges();

        return collect($keys)->mapWithKeys(function ($key) use ($navigations) {
            return [$key => $this->getItem($key, $navigations)];
        });
    }
}
