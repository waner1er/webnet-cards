<?php

declare(strict_types=1);

namespace App\Game\Enum;

enum CardValue: string
{
    case Two = '2';
    case Three = '3';
    case Four = '4';
    case Five = '5';
    case Six = '6';
    case Seven = '7';
    case Eight = '8';
    case Nine = '9';
    case Ten = '10';
    case Jack = 'J';
    case Queen = 'Q';
    case King = 'K';
    case Ace = 'A';

    public function label(): string
    {
        return match ($this) {
            self::Two => 'Deux',
            self::Three => 'Trois',
            self::Four => 'Quatre',
            self::Five => 'Cinq',
            self::Six => 'Six',
            self::Seven => 'Sept',
            self::Eight => 'Huit',
            self::Nine => 'Neuf',
            self::Ten => 'Dix',
            self::Jack => 'Valet',
            self::Queen => 'Dame',
            self::King => 'Roi',
            self::Ace => 'As',
        };
    }
}
