<?php

namespace Tests\Unit\Helpers;

use App\Helpers\QuotesHelper;
use PHPUnit\Framework\TestCase;

class QuotesHelperTest extends TestCase
{
    public function testShuffled(): void
    {
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
        $result1 = QuotesHelper::shuffled($quotes, 5);
        $result2 = QuotesHelper::shuffled($quotes, 5);
        $this->assertCount(5, $result1);
        $this->assertNotEquals($result1, $result2);
    }
}
