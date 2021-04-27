<?php

namespace Treeware\Plant\Command;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;

class Provider implements CommandProviderCapability
{
    /**
     * @return \Composer\Command\BaseCommand[]
     */
    public function getCommands()
    {
        return [new TreewareCommand()];
    }
}
