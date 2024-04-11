<?php

declare(strict_types=1);

namespace App\Services\Quotes;

use App\Exceptions\QuoteDriverException;
use App\Services\Quotes\Drivers\ApiDriver;
use App\Services\Quotes\Drivers\Interfaces\ApiDriverInterface;
use Illuminate\Support\Manager;

class QuoteManager extends Manager
{
    public function createAPIDriver(): ApiDriverInterface
    {
        return new ApiDriver;
    }
    public function getDefaultDriver(): void
    {
        throw new QuoteDriverException('No Quote API Driver is available');
    }
}
