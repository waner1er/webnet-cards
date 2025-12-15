<?php

declare(strict_types=1);

namespace App\Game;

use App\Game\Enum\Suit;
use App\Game\Enum\CardValue;
use App\Game\Service\SorterInterface;
use App\Game\Service\RandomOrderGenerator;

class GameManager
{

    public function __construct(
        private Deck $deck,
        private SorterInterface $sorter,
        private RandomOrderGenerator $randomOrderGenerator
    ) {}

    public function drawHand(int $count, ?array $customSuits = null, ?array $customValues = null): array
    {
        $handCards = $this->deck->draw($count);

        $suitsOrder = $customSuits ?? $this->randomOrderGenerator->generate(Suit::cases());
        $valuesOrder = $customValues ?? $this->randomOrderGenerator->generate(CardValue::cases());

        $nonSortedHand = $handCards;

        $sortedHand = $this->sorter->sortHand([...$handCards], $suitsOrder, $valuesOrder);

        return  [
            'sorted' => $sortedHand,
            'non_sorted' => $nonSortedHand,
            'suits_order' => $suitsOrder,
            'values_order' => $valuesOrder,
        ];
    }

    public function getDeckCount(): int
    {
        return $this->deck->count();
    }
}
