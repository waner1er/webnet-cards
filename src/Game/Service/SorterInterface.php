<?php

declare(strict_types=1);

namespace App\Game\Service;

interface SorterInterface
{
    public function sortHand(array $hand, array $suitsOrder, array $valuesOrder): array;
}
