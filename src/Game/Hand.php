<?php

declare(strict_types=1);

namespace App\Game;

class Hand
{
    private array $cards = [];

    public function add(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function __toString(): string
    {
        return implode(', ', array_map(fn($c) => (string)$c, $this->cards));
    }
}
