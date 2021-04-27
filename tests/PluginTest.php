<?php

use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Treeware\Plant\Command\Provider;

test('initialize event subscribers', function ()
{
    $map = \Treeware\Plant\Plugin::getSubscribedEvents();
    expect($map)->toEqual(['post-update-cmd' => 'showBanner']);
});

test('initialize composer command', function ()
{
    $plugin = new \Treeware\Plant\Plugin();
    expect($plugin)->toBeInstanceOf(Capable::class);
    expect($plugin->getCapabilities())->toEqual([
        CommandProvider::class => Provider::class,
    ]);
});
