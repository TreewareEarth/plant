<?php

namespace Treeware\Plant;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use Treeware\Plant\Command\Provider;
use Symfony\Component\Console\Input\ArgvInput;

class Plugin implements PluginInterface, EventSubscriberInterface, Capable
{
    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var IOInterface
     */
    protected $io;

    /**
     * @var \Treeware\Plant\PackageRepo
     */
    protected $packageRepo;

    /**
     * Register Composer events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ScriptEvents::POST_UPDATE_CMD => 'showBanner'
        ];
    }

    public function getCapabilities()
    {
        return [
            CommandProvider::class => Provider::class,
        ];
    }

    /**
     * Initialize Composer plugin
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io       = $io;
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // Not implemented
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // Not implemented
    }


    public function showBanner(): void
    {
        $filter   = $this->getFilteredPackages();
        $repo     = $this->packageRepo ?: new PackageRepo($this->composer);
        $packages = $repo->getTreewareMeta();
        $count    = count($packages);

        // No treeware packages
        if (0 === $count) {
            return;
        }

        // No filter, full update: tiny hint
        if (0 === count($filter)) {
            $this->io->write(PHP_EOL);
            $this->io->write("🌳 <options=bold>{$count} packages you are using with a Treeware licence</>");
            $this->io->write("🌳 use the `composer treeware` command to find out more!");
            return;
        }

        // update/require: full info
        foreach ($packages as $package) {

            if (in_array($package->name, $filter)) {

                $headline  = "<options=bold>Treeware licence of {$package->name} - {$package->description}</>";
                $underline = str_repeat('-', strlen($headline));
                $this->io->write(PHP_EOL);
                $this->io->write("🌳 $headline");
                $this->io->write("🌳 $underline");

                foreach ($package->teaser as $line) {
                    $this->io->write("🌳 $line");
                }

                foreach ($package->prices as $key => $price) {
                    $this->io->write("🌳 ⤑ $price ($key)");
                }

                $this->io->write("🌳 Donate using this link: <options=underscore>{$package->url}</>" . PHP_EOL);
            }

        }
    }

    /**
     * A list of packages passed to the require or update command
     * If the list is empty, no filter was applied (full update)
     */
    private function getFilteredPackages(): array
    {
        foreach (debug_backtrace() as $trace) {
            if (!isset($trace['object']) || !isset($trace['args'][0])) {
                continue;
            }

            if (!$trace['args'][0] instanceof ArgvInput) {
                continue;
            }

            /** @var ArgvInput $input */
            $input = $trace['args'][0];

            return $input->getArgument('packages');
        }

        return [];
    }

}
