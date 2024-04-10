<?php

namespace App\Services\Quotes\Storage\Interfaces;

use App\Services\Quotes\QuoteManager;
use Symfony\Component\Console\Helper\ProgressBar;

interface StorageManagerInterface
{
    /**
     * @param QuoteManager $manager
     * @param int $limit
     * @param ProgressBar|null $bar
     * @return void
     */
    public function fetch(QuoteManager $manager, int $limit, ProgressBar $bar = null): void;
}
