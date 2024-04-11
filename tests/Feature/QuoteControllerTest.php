<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class QuoteControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('auth.api_token', 'test-token');

        $this->preparation();
    }

    private function preparation(): void
    {
        Cache::flush();

        $quotes = [
            'Quote one',
            'Quote two',
            'Quote three',
            'Quote four',
            'Quote five',
            'Quote six',
            'Quote seven',
            'Quote eight',
            'Quote nine',
            'Quote ten',
        ];

        Quote::insert(array_map(function ($quote) {
            return ['quote' => $quote];
        }, $quotes));

        Cache::rememberForever('quotes', function () {
            return Quote::all()->pluck('quote')->toArray();
        });
    }

    public function testAuthorised(): void
    {
        $response = $this->getJson('/api/quotes?api_token=' . config('auth.api_token'));

        $response->assertStatus(200);
    }

    public function testUnauthorised(): void
    {
        $response = $this->getJson('/api/quotes');

        $response->assertStatus(401);
    }

    public function testQuote(): void
    {
        $response = $this->getJson('/api/quotes?api_token=' . config('auth.api_token'));

        $response->assertJsonCount(5, 'data');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'quote',
                ],
            ],
        ]);
    }

    public function testQuotesRefresh(): void
    {
        $response = $this->getJson('/api/quotes?api_token=' . config('auth.api_token'));
        $quotesOne = $response->json();

        self::assertCount(5, $quotesOne['data']);

        $response = $this->getJson('/api/quotes?api_token=' . config('auth.api_token'));
        $quotesTwo = $response->json();

        self::assertCount(5, $quotesTwo['data']);
        self::assertNotEquals($quotesOne, $quotesTwo);
    }
}
