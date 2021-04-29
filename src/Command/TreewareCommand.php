<?php

namespace Treeware\Plant\Command;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Treeware\Plant\Output\PackageList;
use Treeware\Plant\PackageRepo;
use Treeware\Plant\PackageStatsClient;

class TreewareCommand extends BaseCommand
{
    public const SUCCESS = 0;

    public const FAILURE = 1;

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $repo = new PackageRepo($this->getComposer(), new PackageStatsClient());
        $packages = $repo->getTreewareWithStats();

        (new PackageList($output, $packages))->show();

        return self::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setName('treeware');
        $this->setDescription('List installed Treeware packages.');
    }
}
