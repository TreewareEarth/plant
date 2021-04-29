<?php

namespace Treeware\Plant\Output;

use Composer\IO\IOInterface;
use Treeware\Plant\Package;

class SinglePackage
{
    /**
     * @var IOInterface
     */
    protected $io;

    /**
     * @var \Treeware\Plant\Package
     */
    protected $package;

    public function __construct(IOInterface $io, Package $package)
    {
        $this->io = $io;
        $this->package = $package;
    }

    public function show(): void
    {
        $headline = "<options=bold>Treeware licence of {$this->package->name} - {$this->package->description}</>";
        $underline = str_repeat('-', strlen($headline));
        $this->io->write(PHP_EOL);
        $this->io->write("🌳 $headline");
        $this->io->write("🌳 $underline");

        foreach ($this->package->teaser as $line) {
            $this->io->write("🌳 $line");
        }

        foreach ($this->package->priceGroups as $group => $price) {
            $this->io->write("🌳 ⤑ $price ($group)");
        }

        $this->io->write(
            "🌳 Donate using this link: <options=underscore>{$this->package->url}</>" . PHP_EOL
        );
    }
}
