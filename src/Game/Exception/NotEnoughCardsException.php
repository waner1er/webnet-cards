<?php

declare(strict_types=1);

namespace App\Game\Exception;

use RuntimeException;

class NotEnoughCardsException extends RuntimeException
{
    public static function create(int $requested, int $available): self
    {
        return new self(sprintf('Impossible de tirer %d cartes. Il ne reste que %d cartes dans le paquet.', $requested, $available));
    }
}
