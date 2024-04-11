<?php

declare(strict_types=1);

namespace App\Services\Quotes\Storage;

use App\Models\Quote;
use App\Services\Quotes\QuoteManager;
use App\Services\Quotes\Storage\Interfaces\StorageManagerInterface;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Helper\ProgressBar;

class StorageManager implements StorageManagerInterface
{
    /**
     * @param QuoteManager $manager
     * @param int $limit
     * @param ProgressBar|null $bar
     * @return void
     */
    public function fetch(QuoteManager $manager, int $limit, ProgressBar $bar = null): void
    {
        Cache::clear();

        for ($i = 0; $i < $limit; $i++) {
            $quote = $manager->driver(config('quotes.driver'))->getQuotes(1);
            Quote::updateOrInsert(['quote' => reset($quote)]);
            usleep(100 * 1000); // 100ms
            if ($bar !== null) {
                $bar->advance();
            }
        }

        Cache::rememberForever('quotes', function () {
            return Quote::all()->pluck('quote')->toArray();
        });
    }
}
