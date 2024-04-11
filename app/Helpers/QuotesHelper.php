<?php

declare(strict_types=1);

namespace App\Helpers;

class QuotesHelper
{
    public static function shuffled(array $quotes, int $length): array
    {
        shuffle($quotes);
        return array_slice($quotes, 0, $length);
    }
}
