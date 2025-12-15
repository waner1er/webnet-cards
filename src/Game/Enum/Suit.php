<?php

declare(strict_types=1);

namespace App\Game\Enum;

enum Suit: string
{
    case Hearts   = 'Coeurs';
    case Diamonds = 'Carreaux';
    case Clubs    = 'Trefles';
    case Spades   = 'Piques';

    public function label(): string
    {
        return match ($this) {
            self::Hearts => 'Coeurs',
            self::Diamonds => 'Carreaux',
            self::Clubs => 'Trefles',
            self::Spades => 'Piques',
        };
    }
}
