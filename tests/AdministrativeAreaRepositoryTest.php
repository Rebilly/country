<?php

declare(strict_types=1);

namespace Country;

use PHPUnit\Framework\TestCase;
use function count;

final class AdministrativeAreaRepositoryTest extends TestCase
{
    /**
     * @var AdministrativeAreaRepository
     */
    private $subject;

    /**
     * @var CountryRepository
     */
    private $countryRepository;

    protected function setUp(): void
    {
        $this->countryRepository = new CountryRepository();
        $this->subject = new AdministrativeAreaRepository($this->countryRepository);
    }

    /**
     * @test
     */
    public function findByCountry(): void
    {
        $expected = 57;

        $country = $this->countryRepository->findByIsoAlpha2('US');

        $result = $this->subject->findByCountry($country);
        self::assertSame($expected, count($result));
    }

    /**
     * @test
     */
    public function findByNameAndCountry(): void
    {
        $expected = 'CA';

        $name = 'California';
        $country = $this->countryRepository->findByIsoAlpha2('US');

        $administrativeArea = $this->subject->findByNameAndCountry($name, $country);
        self::assertSame($expected, $administrativeArea->getCode());
    }

    /**
     * @test
     */
    public function findByNameAndCountryWithInvalidNameThrowsException(): void
    {
        $country = $this->countryRepository->findByIsoAlpha2('US');

        $this->expectException(RecordNotFoundException::class);
        $this->subject->findByNameAndCountry('Invalid', $country);
    }
}
