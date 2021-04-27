<?php

namespace Treeware\Plant\Output;

use Symfony\Component\Console\Output\OutputInterface;

class PackageList
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var \Treeware\Plant\Package[]
     */
    protected $packages;

    public function __construct(OutputInterface $output, array $packages)
    {
        $this->output = $output;
        $this->packages = $packages;
    }

    public function show(): void
    {
        foreach ($this->packages as $package) {
            $this->output->writeln("🌳 {$package->name}");
            $this->output->writeln("⤑ Description: {$package->description}");
            $this->output->writeln("⤑ Donate: {$package->url}");

            if ($package->treeCount > 0) {
                $this->output->writeln("⤑ Tree count: {$package->treeCount}");
            } else {
                $this->output->writeln("⤑ No trees donated so far 😢");
            }

            $this->output->write(PHP_EOL);
        }
    }
}
