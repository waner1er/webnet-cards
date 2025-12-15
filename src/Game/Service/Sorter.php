<?php

declare(strict_types=1);

namespace App\Game\Service;

use App\Game\Card;

class Sorter implements SorterInterface
{
    public function sortHand(array $hand, array $suitsOrder, array $valuesOrder): array
    {
        $suitPriorityMap = array_flip(array_map(fn($suit) => $suit->value, $suitsOrder));
        $valuePriorityMap = array_flip(array_map(fn($value) => $value->value, $valuesOrder));

        usort($hand, function (Card $cardA, Card $cardB) use ($suitPriorityMap, $valuePriorityMap) {
            $suitComparison = $suitPriorityMap[$cardA->getSuit()->value] - $suitPriorityMap[$cardB->getSuit()->value];

            if ($suitComparison !== 0) {
                return $suitComparison;
            }

            return $valuePriorityMap[$cardA->getValue()->value] - $valuePriorityMap[$cardB->getValue()->value];
        });

        return $hand;
    }
}
