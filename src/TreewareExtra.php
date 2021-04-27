<?php

namespace Treeware\Plant;

class TreewareExtra
{
    public const BASE_URL = 'https://plant.treeware.earth';

    public const PRICE_DEFAULTS = [
        'useful' => '$10',
        'important' => '$50',
        'critical' => '$150',
    ];

    public const TEASER_DEFAULT = [
        'The author of this open-source software cares about the climate crisis.',
        'Using the software in a commercial project requires a donation:',
    ];

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $url;

    /**
     * @var array
     */
    public $prices;

    /**
     * @var array
     */
    public $teaser;

    public function __construct(
        string $name,
        string $description,
        array $prices = [],
        array $teaser = []
    ) {
        $this->name = $name;
        $this->prices = count($prices) ? $prices : self::PRICE_DEFAULTS;
        $this->teaser = count($teaser) ? $teaser : self::TEASER_DEFAULT;
        $this->description = $description;
        $this->url = sprintf('%s/%s', self::BASE_URL, $name);
    }
}
