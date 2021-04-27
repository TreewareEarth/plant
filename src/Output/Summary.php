<?php

namespace Treeware\Plant\Output;

use Composer\IO\IOInterface;

class Summary
{
    /**
     * @var IOInterface
     */
    protected $io;

    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    public function show(int $count): void
    {
        $this->io->write(PHP_EOL);
        $this->io->write(
            "🌳 <options=bold>{$count} packages you are using with a Treeware licence</>"
        );
        $this->io->write('🌳 use the `composer treeware` command to find out more!');
    }
}
