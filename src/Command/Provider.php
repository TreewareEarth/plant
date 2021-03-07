<?php

namespace ostark\Plant\Command;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use ostark\Plant\PackageRepo;


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
