<?php
declare(strict_types=1);

namespace Country;

use PHPUnit\Framework\TestCase;

final class CountryRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function findByIsoAlpha2ReturnsCorrectCountry(): void
    {
        $country = $this->getCountryRepository()->findByIsoAlpha2('US');
        self::assertSame('United States', $country->getCommonName());
        self::assertSame('United States of America', $country->getOfficialName());
        self::assertSame('North America', $country->getContinent());
        self::assertSame('us', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByIsoAlpha2WithInvalidIsoAlpha2ThrowsException(): void
    {
        $this->expectExceptionObject(new RecordNotFoundException('Cannot find country with ISO alpha2 "XY"'));
        $this->getCountryRepository()->findByIsoAlpha2('XY');
    }

    /**
     * @test
     */
    public function hasWithIsoAlpha2(): void
    {
        self::assertTrue($this->getCountryRepository()->hasWithIsoAlpha2('US'));
        self::assertFalse($this->getCountryRepository()->hasWithIsoAlpha2('XY'));
    }

    /**
     * @test
     */
    public function findByNameFindsCorrectCountry(): void
    {
        $country = $this->getCountryRepository()->findByName('United Kingdom');
        self::assertSame('United Kingdom', $country->getCommonName());
        self::assertSame('United Kingdom of Great Britain and Northern Ireland', $country->getOfficialName());
        self::assertSame('Europe', $country->getContinent());
        self::assertSame('gb', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByNameIgnoresCase(): void
    {
        $country = $this->getCountryRepository()->findByName('united kingdom');
        self::assertSame('United Kingdom', $country->getCommonName());
        self::assertSame('United Kingdom of Great Britain and Northern Ireland', $country->getOfficialName());
        self::assertSame('Europe', $country->getContinent());
        self::assertSame('gb', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByNameIgnoresAccentsAndCases(): void
    {
        $country = $this->getCountryRepository()->findByName('Åland islands');
        self::assertSame('Åland Islands', $country->getCommonName());
        self::assertSame('Åland Islands', $country->getOfficialName());
        self::assertSame('Europe', $country->getContinent());
        self::assertSame('ax', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByAliases(): void
    {
        $country = $this->getCountryRepository()->findByName('North Macedonia');
        self::assertSame('North Macedonia', $country->getCommonName());

        $aliases = [
            'Macedonia',
            'Republic of Macedonia',
            'The Former Yugoslav Republic of Macedonia',
            'Macedonia, The former Yugoslav Republic of',
        ];
        foreach ($aliases as $alias) {
            $this->getCountryRepository()->findByName($alias)->equals($country);
        }
    }

    /**
     * @test
     */
    public function findByNameWithInvalidNameThrowsException(): void
    {
        $this->expectExceptionObject(new RecordNotFoundException('Cannot find country with name "Invalid Country"'));
        $this->getCountryRepository()->findByName('Invalid Country');
    }

    /**
     * @test
     */
    public function findByOfficialNameReturnsCorrectCountry(): void
    {
        $country = $this->getCountryRepository()->findByOfficialName('Republic of Zimbabwe');
        self::assertSame('Zimbabwe', $country->getCommonName());
        self::assertSame('Republic of Zimbabwe', $country->getOfficialName());
        self::assertSame('Africa', $country->getContinent());
        self::assertSame('zw', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByOfficialNameWithInvalidNameThrowsException(): void
    {
        $this->expectException(RecordNotFoundException::class);
        $this->getCountryRepository()->findByOfficialName('Rebilly');
    }

    /**
     * @test
     */
    public function hasWithOfficialName(): void
    {
        $this->assertTrue($this->getCountryRepository()->hasWithOfficialName('United States of America'));
        $this->assertFalse($this->getCountryRepository()->hasWithOfficialName('States'));
    }

    /**
     * @test
     */
    public function hasWithCommonName(): void
    {
        $this->assertTrue($this->getCountryRepository()->hasWithCommonName('United States'));
        $this->assertFalse($this->getCountryRepository()->hasWithCommonName('States'));
    }

    /**
     * @test
     */
    public function findByCommonNameReturnsCorrectCountry(): void
    {
        $country = $this->getCountryRepository()->findByCommonName('United States');
        self::assertSame('United States', $country->getCommonName());
        self::assertSame('United States of America', $country->getOfficialName());
        self::assertSame('North America', $country->getContinent());
        self::assertSame('us', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByCommonNameWithInvalidNameThrowsException(): void
    {
        $this->expectException(RecordNotFoundException::class);
        $this->getCountryRepository()->findByCommonName('Rebilly');
    }

    /**
     * @test
     */
    public function findByIsoNumericReturnsCorrectCountry(): void
    {
        $country = $this->getCountryRepository()->findByIsoNumeric(840);
        self::assertSame('United States', $country->getCommonName());
        self::assertSame('United States of America', $country->getOfficialName());
        self::assertSame('North America', $country->getContinent());
        self::assertSame('us', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function hasWithIsoNumeric(): void
    {
        self::assertTrue($this->getCountryRepository()->hasWithIsoNumeric(840));
        self::assertFalse($this->getCountryRepository()->hasWithIsoNumeric(0));
    }

    /**
     * @test
     */
    public function findByIsoNumericWithInvalidNumberThrowsException(): void
    {
        $this->expectException(RecordNotFoundException::class);
        $this->getCountryRepository()->findByIsoNumeric(9999);
    }

    /**
     * @test
     */
    public function getAllRetrievesFullList(): void
    {
        $data = $this->getCountryRepository()->findAll();
        self::assertSame(249, count($data));
        self::assertInstanceOf(Country::class, $data['US']);
        self::assertSame('United States', $data['US']->getCommonName());
    }

    /**
     * @test
     */
    public function findByIsoAlpha3ReturnsCorrectCountry(): void
    {
        $country = $this->getCountryRepository()->findByIsoAlpha3('CAN');
        self::assertSame('Canada', $country->getCommonName());
        self::assertSame('Canada', $country->getOfficialName());
        self::assertSame('North America', $country->getContinent());
        self::assertSame('ca', $country->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByIsoAlpha3WithInvalidIsoAlpha3ThrowsException(): void
    {
        $this->expectExceptionObject(new RecordNotFoundException('Cannot find country with ISO alpha3 code "XYZ"'));
        $this->getCountryRepository()->findByIsoAlpha3('XYZ');
    }

    /**
     * @test
     */
    public function hasWithIsoAlphaFoundValidCountry(): void
    {
        self::assertSame(true, $this->getCountryRepository()->hasWithIsoAlpha3('USA'));
    }

    /**
     * @test
     */
    public function hasWithIsoAlphaNotFoundInvalidCountry(): void
    {
        self::assertSame(false, $this->getCountryRepository()->hasWithIsoAlpha3('USE'));
    }

    private function getCountryRepository(): CountryRepository
    {
        return new CountryRepository();
    }
}
