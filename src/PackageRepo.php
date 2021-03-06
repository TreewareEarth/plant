<?php

namespace ostark\Plant;


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
     * @return \ostark\Plant\Treeware[]
     */
    public function getTreeware()
    {
        $packages = [];

        foreach ($this->repo->getPackages() as $package) {

            $extra = $package->getExtra();

            if (isset($extra['treeware'])) {

                $packages[] = new Treeware(
                    $package->getName(),
                    $package->getDescription() ,
                    $extra['treeware']['prices'] ?? null
                );
            }
        }

        return $packages;
    }

}
