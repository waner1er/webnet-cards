<?php

declare(strict_types=1);

namespace App\Game\Enum;

enum Suit: string
{
    case Hearts   = 'hearts';
    case Diamonds = 'diamonds';
    case Clubs    = 'clubs';
    case Spades   = 'spades';

    public function label(): string
    {
        return match ($this) {
            self::Hearts => 'hearts',
            self::Diamonds => 'diamonds',
            self::Clubs => 'clubs',
            self::Spades => 'spades',
        };
    }
}
