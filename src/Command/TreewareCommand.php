<?php

namespace Treeware\Plant\Command;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Treeware\Plant\PackageRepo;

class TreewareCommand extends BaseCommand
{
    protected function configure(): void
    {
        $this->setName('treeware');
        $this->setDescription('List treeware packages.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $repo = new PackageRepo($this->getComposer());
        $packages = $repo->getTreewareMeta();

        foreach ($packages as $package) {
            $output->writeln("🌳 ⤑ {$package->description}: {$package->url}");
        }

        return Command::SUCCESS;
    }
}
