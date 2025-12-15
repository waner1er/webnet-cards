<?php

namespace App\Game;

use App\Game\Enum\Suit;
use App\Game\Enum\CardValue;

class Card
{
    private Suit $suit;
    private CardValue $value;

    public function __construct(Suit $suit, CardValue $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit(): Suit
    {
        return $this->suit;
    }

    public function getValue(): CardValue
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return sprintf("%s de %s", $this->value->label(), $this->suit->label());
    }
}
