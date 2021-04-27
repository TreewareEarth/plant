<?php

namespace Treeware\Plant;

use Exception;

class PackageStatsClient
{
    public const STATS_ENDPOINT = 'https://api.ecologi.com/users/treeware/trees';

    public function getTreeCount(string $name): ?int
    {
        $ref = md5(strtolower($name));
        $context = stream_context_create([
            'http' => [
                'timeout' => 2,

            ],
        ]);

        try {
            $response = file_get_contents(
                sprintf('%s?ref=%s', self::STATS_ENDPOINT, $ref),
                false,
                $context
            );

            if ($response !== null) {
                $jsonObj = json_decode($response, false, 2, JSON_THROW_ON_ERROR);
                return $jsonObj->total;
            }
        } catch (Exception $e) {
        }

        return null;
    }
}
