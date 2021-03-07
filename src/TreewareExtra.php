<?php

namespace ostark\Plant;

class TreewareExtra
{
    const BASE_URL = "https://plant.treeware.earth";

    const PRICE_DEFAULTS = [
        'useful' => '$10',
        'important' => '$50',
        'critical' => '$150'
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

    public function __construct(string $name, string $description, array $prices = [])
    {
        $this->name = $name;
        $this->prices = count($prices) ? $prices : self::PRICE_DEFAULTS;
        $this->description = $description;
        $this->url = sprintf("%s/%s", self::BASE_URL, $name);
    }

}
