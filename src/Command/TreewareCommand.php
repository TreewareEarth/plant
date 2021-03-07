<?php

namespace ostark\Plant\Command;

use Composer\Command\BaseCommand;
use ostark\Plant\PackageRepo;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TreewareCommand extends BaseCommand
{


    protected function configure()
    {
        $this->setName('treeware');
        $this->setDescription('List treeware packages.');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repo = new PackageRepo($this->getComposer());
        $packages = $repo->getTreewareMeta();

        foreach ($packages as $package) {
            $output->writeln("🌳 ⤑ {$package->description}: {$package->url}");
        }

    }
}
