<?php
declare(strict_types=1);

namespace App\Services\Quotes\Drivers;

use App\Services\Quotes\Drivers\AbstractApiDriver;

class ApiDriver extends AbstractApiDriver
{
    /**
     * @param string $url
     */
    public function __construct(private readonly string $url = 'https://api.kanye.rest')
    {
    }

    /**
     * @param int $count
     * @return array
     */
    public function getQuotes(int $count = 1): array
    {
        return $this->makeRequest($this->url, $count);
    }
}
