<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Assets\AssetContainer as StatamicAssetContainer;
use Statamic\Stache\Repositories\AssetContainerRepository as StatamicAssetContainerRepository;
use Statamic\Stache\Stache;

class AssetContainerRepository extends StatamicAssetContainerRepository
{
    /**
     * @var Collection
     */
    private $assetContainers;

    public function __construct(Stache $stache)
    {
        parent::__construct($stache);

        $this->initializeAssetContainers();
    }

    private function initializeAssetContainers()
    {
        $containers = collect(config('statamic.builder.asset_containers', []));

        $this->assetContainers = collect();

        $containers->each(function (string $container): void {
            if (class_exists($container, true)) {
                $this->assetContainers->put($container::handle(), $container);
            }
        });
    }

    public function findByHandle($handle): ?StatamicAssetContainer
    {
        $container = $this->assetContainers->get($handle);

        if ($container) {
            return (new $container)->register();
        }

        return parent::findByHandle($handle);
    }

    public function all(): Collection
    {
        $keys = $this->store->paths()->keys()->merge($this->assetContainers->keys())->unique();

        return $keys->map(function ($key) {
            return $this->findByHandle($key);
        })->filter();
    }

    public function getAssetContainerByHandle($handle): ?\Tdwesten\StatamicBuilder\BaseAssetContainer
    {
        $container = $this->assetContainers->get($handle, null);

        if ($container) {
            return new $container;
        }

        return null;
    }
}
