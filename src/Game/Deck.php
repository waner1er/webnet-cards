<?php

declare(strict_types=1);

namespace App\Game;

use App\Game\Enum\Suit;
use App\Game\Enum\CardValue;

class Deck
{
    private array $cards = [];

    public function __construct()
    {
        $this->generate();
        $this->shuffle();
    }

    private function generate(): void
    {
        foreach (Suit::cases() as $suit) {
            foreach (CardValue::cases() as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function draw(int $count = 1): array
    {
        $drawn = [];
        for ($i = 0; $i < $count; $i++) {
            $card = array_pop($this->cards);
            if ($card) $drawn[] = $card;
        }
        return $drawn;
    }

    public function count(): int
    {
        return count($this->cards);
    }
}
