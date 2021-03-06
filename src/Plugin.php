<?php

namespace ostark\Plant;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface, EventSubscriberInterface
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
     * @var \ostark\Plant\PackageRepo
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


    public function showBanner()
    {
        $repo = $this->packageRepo ?: new PackageRepo($this->composer);
        $packages = $repo->getTreeware();

        if ($packages) {

            foreach ($packages as $package) {

                $headline = "<options=bold>Treeware licence of {$package->name} - {$package->description}</>";
                $underline = str_repeat('-', strlen($headline));
                $this->io->write(PHP_EOL);
                $this->io->write("🌳 $headline");
                $this->io->write("🌳 $underline");
                $this->io->write("🌳 The author of this open-source software cares about the climate crisis.");
                $this->io->write("🌳 Using the software in a commercial project requires a donation:");

                foreach ($package->prices as $key => $price) {
                    $this->io->write("🌳 ⤑ $price ($key)");
                }

                $this->io->write("🌳 Donate using this link: <options=underscore>{$package->url}</>" . PHP_EOL);
            }
        }
    }
}
