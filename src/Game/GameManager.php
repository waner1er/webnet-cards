<?php

declare(strict_types=1);

namespace App\Game;

use App\Game\Enum\Suit;
use App\Game\Enum\CardValue;
use App\Game\Service\SorterInterface;
use App\Game\Service\RandomOrderGenerator;
use App\Game\Exception\InvalidCardCountException;
use App\Game\Exception\NotEnoughCardsException;

class GameManager
{
    private const MIN_CARDS = 1;
    private const MAX_CARDS = 52;

    public function __construct(
        private Deck $deck,
        private SorterInterface $sorter,
        private RandomOrderGenerator $randomOrderGenerator
    ) {}

    public function drawHand(int $count, ?array $customSuits = null, ?array $customValues = null): array
    {
        $this->validateCardCount($count);

        if ($count > $this->deck->count()) {
            throw NotEnoughCardsException::create($count, $this->deck->count());
        }

        $handCards = $this->deck->draw($count);

        $suitsOrder = $customSuits ?? Suit::cases();
        $valuesOrder = $customValues ?? CardValue::cases();

        $nonSortedHand = $handCards;
        $sortedHand = $this->sorter->sortHand([...$handCards], $suitsOrder, $valuesOrder);

        return [
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

    private function validateCardCount(int $count): void
    {
        if ($count < self::MIN_CARDS || $count > self::MAX_CARDS) {
            throw InvalidCardCountException::outOfRange($count, self::MIN_CARDS, self::MAX_CARDS);
        }
    }
}
