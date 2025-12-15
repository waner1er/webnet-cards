<?php

declare(strict_types=1);

namespace App\Game\Service;

use App\Game\Card;

class Sorter implements SorterInterface
{
    public function sortHand(array $hand, array $suitsOrder, array $valuesOrder): array
    {
        usort($hand, function (Card $a, Card $b) use ($suitsOrder, $valuesOrder) {
            $suitIndexA = $this->findIndex($a->getSuit(), $suitsOrder);
            $suitIndexB = $this->findIndex($b->getSuit(), $suitsOrder);

            if ($suitIndexA !== $suitIndexB) {
                return $suitIndexA <=> $suitIndexB;
            }

            $valueIndexA = $this->findIndex($a->getValue(), $valuesOrder);
            $valueIndexB = $this->findIndex($b->getValue(), $valuesOrder);

            return $valueIndexA <=> $valueIndexB;
        });

        return $hand;
    }

    private function findIndex(mixed $element, array $array): int
    {
        foreach ($array as $index => $item) {
            if ($element === $item) {
                return $index;
            }
        }

        return PHP_INT_MAX;
    }
}
