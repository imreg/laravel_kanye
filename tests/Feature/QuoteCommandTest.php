<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class QuoteCommandTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            '*' => Http::response([
                'quote' => 'All the musicians will be free',
            ]),
        ]);

        Cache::flush();
    }

    public function testQuote(): void
    {
        Artisan::call('app:quote', ['--count' => 1]);

        self::assertDatabaseHas('quotes', [
            'quote' => 'All the musicians will be free',
        ]);
    }

    public function testCacheHasAQuote(): void
    {
        Artisan::call('app:quote', ['--count' => 1]);

        $quotes = Cache::get('quotes');

        self::assertCount(1,  $quotes);
    }
}
