<?php

namespace App\Services\Quotes\Drivers\Interfaces;

interface ApiDriverInterface
{
    /**
     * @param int $count
     * @return array
     */
    public function getQuotes(int $count): array;
}
