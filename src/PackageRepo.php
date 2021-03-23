<?php

namespace Treeware\Plant;


use Composer\Composer;
use Composer\Repository\InstalledRepositoryInterface;

class PackageRepo
{
    /**
     * @var InstalledRepositoryInterface
     */
    protected $repo;

    public function __construct(Composer $composer)
    {
        $this->repo = $composer->getRepositoryManager()->getLocalRepository();
    }

    /**
     * @return \Treeware\Plant\TreewareExtra[]
     */
    public function getTreewareMeta()
    {
        $packages = [];

        foreach ($this->repo->getPackages() as $package) {

            $extra = $package->getExtra();

            if (isset($extra['treeware'])) {
                $packages[] = new TreewareExtra(
                    $package->getName(),
                    $package->getDescription(),
                    $extra['treeware']['prices'] ?? [],
                    $extra['treeware']['teaser'] ?? []
                );
            }
        }

        return $packages;
    }

}
