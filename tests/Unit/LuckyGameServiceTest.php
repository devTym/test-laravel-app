<?php

namespace Tests\Unit;

use App\Services\LuckyGameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LuckyGameServiceTest extends TestCase
{
//    use RefreshDatabase;

    protected LuckyGameService $luckyGameService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->luckyGameService = app(LuckyGameService::class);
    }

    #[DataProvider('getWinNumberDataProvider')]
    public function test_calculate_win_sum($winNumber, $expected)
    {
        $service = new LuckyGameService();

        $reflection = new \ReflectionClass(LuckyGameService::class);
        $method = $reflection->getMethod('calculateWinSum');

        $this->assertEquals($expected, $method->invoke($service, $winNumber));

    }

    public static function getWinNumberDataProvider(): array
    {
        return [
            'Win number 1000'   => [1000, 700],
            'Win number 800'    => [800, 400],
            'Win number 500'    => [500, 150],
            'Win number 100'    => [100, 10],
        ];
    }
}
