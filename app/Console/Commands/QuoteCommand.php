<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Quotes\QuoteManager;
use App\Services\Quotes\Storage\StorageManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class QuoteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:quote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private int $count = 100;

    /**
     * Execute the console command.
     */
    public function handle(QuoteManager $manager)
    {
        $count = config('quotes.fetch_max') ?? $this->count;

        try {
            $this->info('Warming quote cache...');

            $bar = $this->output->createProgressBar($this->count);

            $bar->start();
            $storage = new StorageManager();
            $storage->fetch($manager, $this->count, $bar);

            $bar->finish();
            $this->output->newLine();

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
