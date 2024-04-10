<?php
declare(strict_types=1);

namespace App\Services\Quotes\Drivers;

use App\Services\Quotes\Drivers\Interfaces\ApiDriverInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

abstract class AbstractApiDriver implements ApiDriverInterface
{
    /**
     * @return array<int, string>
     */
    abstract public function getQuotes(int $count = 1): array;

    /**
     * @return array<int, string>
     */
    public function makeRequest(string $url, int $count = 1): array
    {
        $result = Http::acceptJson()->get($url);

        $data = Arr::flatten($result->json());

        return array_splice($data, 0, $count);
    }
}
