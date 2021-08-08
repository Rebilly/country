<?php

declare(strict_types=1);

namespace Country;

use PHPUnit\Framework\TestCase;

final class AdministrativeAreaTest extends TestCase
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    protected function setUp(): void
    {
        $this->countryRepository = new CountryRepository();
    }

    /**
     * @test
     */
    public function construction(): void
    {
        $usa = $this->countryRepository->findByIsoAlpha2('US');
        $code = 'XX';
        $name = 'Some name';

        $administrativeArea = new AdministrativeArea(
            $code,
            $name,
            $usa
        );

        self::assertInstanceOf(AdministrativeArea::class, $administrativeArea);
        self::assertSame($code, $administrativeArea->getCode());
        self::assertSame($name, $administrativeArea->getName());
        self::assertSame($usa, $administrativeArea->getCountry());
    }

    /**
     * @test
     */
    public function equals(): void
    {
        $usa = $this->countryRepository->findByIsoAlpha2('US');
        $code = 'XX';
        $name = 'Some name';

        $administrativeArea1 = new AdministrativeArea(
            $code,
            $name,
            $usa
        );

        $administrativeArea2 = new AdministrativeArea(
            $code,
            $name,
            $usa
        );

        self::assertTrue($administrativeArea1->equals($administrativeArea2));
    }
}
