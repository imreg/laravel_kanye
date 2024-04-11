<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Quotes\QuoteManager;
use App\Services\Quotes\Storage\StorageManager;
use Illuminate\Console\Command;

class QuoteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:quote {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Quotes and store in Cache';

    private int $count = 100;

    /**
     * Execute the console command.
     */
    public function handle(QuoteManager $manager)
    {

        $count = intval($this->option('count') ?? $this->count);

        try {
            $this->info('Warming quote cache...');

            $bar = $this->output->createProgressBar($count);

            $bar->start();
            $storage = new StorageManager();
            $storage->fetch($manager, $count, $bar);

            $bar->finish();
            $this->output->newLine();

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
