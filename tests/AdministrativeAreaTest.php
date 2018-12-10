<?php

namespace Country;

use PHPUnit\Framework\TestCase;

class AdministrativeAreaTest extends TestCase
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    public function setUp(): void
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

        $this->assertInstanceOf(AdministrativeArea::class, $administrativeArea);
        $this->assertSame($code, $administrativeArea->getCode());
        $this->assertSame($name, $administrativeArea->getName());
        $this->assertSame($usa, $administrativeArea->getCountry());
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

        $this->assertTrue($administrativeArea1->equals($administrativeArea2));
    }
}
