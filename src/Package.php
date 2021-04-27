<?php

namespace Treeware\Plant;

class Package
{
    public const BASE_URL = 'https://plant.treeware.earth';

    public const USD_PER_TREE = 0.168;

    public const PRICE_DEFAULTS = [
        'useful' => 100,
        'important' => 250,
        'critical' => 500,
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
    public $priceGroups;

    /**
     * @var array
     */
    public $teaser;

    /**
     * @var int|null
     */
    public $treeCount = null;

    public function __construct(
        string $name,
        string $description,
        array $priceGroups = [],
        array $teaser = []
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->url = sprintf('%s/%s', self::BASE_URL, $name);
        $this->assignPriceGroups($priceGroups);
        $this->assignTeaser($teaser);
    }

    public function setTreeCount(int $trees): self
    {
        $this->treeCount = $trees;
        return $this;
    }

    private function assignPriceGroups($priceGroups = []): void
    {
        if (count($priceGroups) === 0) {
            $priceGroups = self::PRICE_DEFAULTS;
        }

        foreach ($priceGroups as $group => $trees) {
            // Avoid stupid input
            if (is_int($trees) && strlen($group) < 15) {
                $usd = round($trees * self::USD_PER_TREE);
                $this->priceGroups[$group] = sprintf('%d trees ≈ $%d', $trees, $usd);
            }
        }
    }

    private function assignTeaser($teaser = []): void
    {
        // Avoid stupid input
        if (count($teaser) === 0 || count($teaser) > 3) {
            $teaser = self::TEASER_DEFAULT;
        }
        if (strlen(implode(PHP_EOL, $teaser)) > 200) {
            $teaser = self::TEASER_DEFAULT;
        }

        $this->teaser = $teaser;
    }
}
