<?php

declare(strict_types=1);

namespace App\Game\Exception;

use InvalidArgumentException;

class InvalidCardCountException extends InvalidArgumentException
{
    public static function tooLow(int $count, int $min): self
    {
        return new self(sprintf('Le nombre de cartes (%d) est inférieur au minimum requis (%d).', $count, $min));
    }

    public static function tooHigh(int $count, int $max): self
    {
        return new self(sprintf('Le nombre de cartes (%d) dépasse le maximum autorisé (%d).', $count, $max));
    }

    public static function outOfRange(int $count, int $min, int $max): self
    {
        return new self(sprintf('Le nombre de cartes doit être entre %d et %d. Valeur reçue : %d', $min, $max, $count));
    }
}
