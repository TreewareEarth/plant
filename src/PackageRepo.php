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

    /**
     * @var \Treeware\Plant\PackageStatsClient
     */
    protected $client;

    public function __construct(Composer $composer, PackageStatsClient $client)
    {
        $this->repo = $composer->getRepositoryManager()->getLocalRepository();
        $this->client = $client;
    }

    /**
     * @return \Treeware\Plant\Package[]
     */
    public function getTreeware()
    {
        $treeware = [];

        /** @var \Composer\Package\CompletePackageInterface[] $installedPackages */
        $installedPackages = $this->repo->getPackages();

        foreach ($installedPackages as $package) {
            $extra = $package->getExtra();

            if (isset($extra['treeware'])) {
                $treeware[$package->getName()] = new Package(
                    $package->getName(),
                    $package->getDescription(),
                    $extra['treeware']['priceGroups'] ?? [],
                    $extra['treeware']['teaser'] ?? []
                );
            }
        }

        return $treeware;
    }

    /**
     * @return \Treeware\Plant\Package[]
     */
    public function getTreewareWithStats(): array
    {
        $packages = $this->getTreeware();

        foreach ($packages as $package) {
            $package->setTreeCount($this->client->getTreeCount($package->name));
        }

        return $packages;
    }
}
