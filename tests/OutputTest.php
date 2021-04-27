<?php

use Treeware\Plant\Output\Summary;
uses(\Spatie\Snapshots\MatchesSnapshots::class);

beforeEach(
    function () {
        $in = new \Symfony\Component\Console\Input\ArgvInput();
        $out = new \Symfony\Component\Console\Output\StreamOutput(fopen('php://memory', 'w', false));
        $helper = new \Symfony\Component\Console\Helper\HelperSet();
        $this->io =   new \Composer\IO\ConsoleIO($in, $out, $helper);
        $this->out = $out;
    }
);


test('summary for 5 packages', function () {

    (new Summary($this->io))->show(5);
    rewind($this->out->getStream());

    $this->assertMatchesSnapshot(stream_get_contents($this->out->getStream()));
});


test('single package with default teaser', function () {

    $extra = new \Treeware\Plant\TreewareExtra(
      'tester/toolbox',
      'Cool stuff in a box'
    );

    (new \Treeware\Plant\Output\SinglePackage($this->io, $extra))->show();
    rewind($this->out->getStream());

    $this->assertMatchesSnapshot(stream_get_contents($this->out->getStream()));
});


