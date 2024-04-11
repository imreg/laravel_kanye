<?php
declare(strict_types=1);

namespace Tests\Unit\Service\Quotes;

use App\Services\Quotes\Drivers\AbstractApiDriver;
use App\Services\Quotes\QuoteManager;
use Illuminate\Contracts\Container\Container;
use PHPUnit\Framework\TestCase;

class QuoteManagerTest extends TestCase
{
    private QuoteManager $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $container = $this->createMock(Container::class);
        $this->manager = new QuoteManager($container);
    }

    public function testCreateAPIDriver(): void
    {
        $this->assertInstanceOf(AbstractApiDriver::class, $this->manager->createAPIDriver());
    }

    public function testGetDefaultDriver()
    {
        $this->expectException(\RuntimeException::class);
        $this->manager->getDefaultDriver();
    }
}
