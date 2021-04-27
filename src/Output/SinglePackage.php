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
    protected $extra;

    public function __construct(IOInterface $io, Package $extra)
    {
        $this->io = $io;
        $this->extra = $extra;
    }

    public function show(): void
    {
        $headline = "<options=bold>Treeware licence of {$this->extra->name} - {$this->extra->description}</>";
        $underline = str_repeat('-', strlen($headline));
        $this->io->write(PHP_EOL);
        $this->io->write("🌳 $headline");
        $this->io->write("🌳 $underline");

        foreach ($this->extra->teaser as $line) {
            $this->io->write("🌳 $line");
        }

        foreach ($this->extra->priceGroups as $group => $price) {
            $this->io->write("🌳 ⤑ $price ($group)");
        }

        $this->io->write(
            "🌳 Donate using this link: <options=underscore>{$this->extra->url}</>" . PHP_EOL
        );
    }
}
