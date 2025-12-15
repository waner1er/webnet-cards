<?php

declare(strict_types=1);

namespace App\Game\Service;

class RandomOrderGenerator
{
    public function generate(array $items): array
    {
        $shuffled = $items;
        shuffle($shuffled);
        return $shuffled;
    }
}
