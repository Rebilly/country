<?php

namespace Country;

use PHPUnit\Framework\TestCase;

class CountryRepositoryTest extends TestCase
{
    /**
     * @var CountryRepository;
     */
    private $subject;

    /**
     * Set Up function.
     */
    public function setUp(): void
    {
        $this->subject = new CountryRepository();
    }

    /**
     * @test
     */
    public function findByIsoAlpha2ReturnsCorrectCountry(): void
    {
        $expectedCommonName = 'United States';
        $expectedOfficialName = 'United States of America';
        $expectedContinent = 'North America';
        $expectedTLD = 'us';

        $isoAlpha2 = 'US';

        $result = $this->subject->findByIsoAlpha2($isoAlpha2);

        self::assertInstanceOf(Country::class, $result);
        self::assertSame($expectedCommonName, $result->getCommonName());
        self::assertSame($expectedOfficialName, $result->getOfficialName());
        self::assertSame($expectedContinent, $result->getContinent());
        self::assertSame($expectedTLD, $result->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByIsoAlpha2WithInvalidIsoAlpha2ThrowsException(): void
    {
        $this->expectExceptionObject(
            new RecordNotFoundException('Cannot find country with isoAlpha2 XY')
        );
        $this->subject->findByIsoAlpha2('XY');
    }

    /**
     * @test
     */
    public function findByNameFindsCorrectCountry(): void
    {
        $expectedCommonName = 'United Kingdom';
        $expectedOfficialName = 'United Kingdom of Great Britain and Northern Ireland';
        $expectedContinent = 'Europe';
        $expectedTLD = 'gb';

        $nameQuery = 'United Kingdom';

        $result = $this->subject->findByName($nameQuery);

        self::assertInstanceOf(Country::class, $result);
        self::assertSame($expectedCommonName, $result->getCommonName());
        self::assertSame($expectedOfficialName, $result->getOfficialName());
        self::assertSame($expectedContinent, $result->getContinent());
        self::assertSame($expectedTLD, $result->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByNameWithInvalidNameThrowsException(): void
    {
        $this->expectExceptionObject(
            new RecordNotFoundException('Cannot find country with name Invalid Country')
        );
        $this->subject->findByName('Invalid Country');
    }

    /**
     * @test
     */
    public function findByOfficialNameReturnsCorrectCountry(): void
    {
        $expectedCommonName = 'Zimbabwe';
        $expectedOfficialName = 'Republic of Zimbabwe';
        $expectedContinent = 'Africa';
        $expectedTLD = 'zw';

        $nameQuery = 'Republic of Zimbabwe';

        $result = $this->subject->findByOfficialName($nameQuery);

        self::assertInstanceOf(Country::class, $result);
        self::assertSame($expectedCommonName, $result->getCommonName());
        self::assertSame($expectedOfficialName, $result->getOfficialName());
        self::assertSame($expectedContinent, $result->getContinent());
        self::assertSame($expectedTLD, $result->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByOfficialNameWithInvalidNameThrowsException(): void
    {
        $this->expectException(RecordNotFoundException::class);
        $this->subject->findByOfficialName('Rebilly');
    }

    /**
     * @test
     */
    public function hasWithOfficialName(): void
    {
        $this->assertTrue($this->subject->hasWithOfficialName('United States of America'));
        $this->assertFalse($this->subject->hasWithOfficialName('United States'));
    }

    /**
     * @test
     */
    public function hasWithCommonName(): void
    {
        $this->assertTrue($this->subject->hasWithCommonName('United States'));
        $this->assertFalse($this->subject->hasWithCommonName('United States of America'));
    }

    /**
     * @test
     */
    public function findByCommonNameReturnsCorrectCountry(): void
    {
        $expectedCommonName = 'United States';
        $expectedOfficialName = 'United States of America';
        $expectedContinent = 'North America';
        $expectedTLD = 'us';

        $nameQuery = 'United States';

        $result = $this->subject->findByCommonName($nameQuery);

        self::assertInstanceOf(Country::class, $result);
        self::assertSame($expectedCommonName, $result->getCommonName());
        self::assertSame($expectedOfficialName, $result->getOfficialName());
        self::assertSame($expectedContinent, $result->getContinent());
        self::assertSame($expectedTLD, $result->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByCommonNameWithInvalidNameThrowsException(): void
    {
        $this->expectException(RecordNotFoundException::class);
        $this->subject->findByCommonName('Rebilly');
    }

    /**
     * @test
     */
    public function findByIsoNumericReturnsCorrectCountry(): void
    {
        $expectedCommonName = 'United States';
        $expectedOfficialName = 'United States of America';
        $expectedContinent = 'North America';
        $expectedTLD = 'us';

        $isoNumericQuery = 840;

        $result = $this->subject->findByIsoNumeric($isoNumericQuery);

        self::assertInstanceOf(Country::class, $result);
        self::assertSame($expectedCommonName, $result->getCommonName());
        self::assertSame($expectedOfficialName, $result->getOfficialName());
        self::assertSame($expectedContinent, $result->getContinent());
        self::assertSame($expectedTLD, $result->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByIsoNumericWithInvalidNumberThrowsException(): void
    {
        $this->expectException(RecordNotFoundException::class);
        $this->subject->findByIsoNumeric(9999);
    }

    /**
     * @test
     */
    public function getAllRetrievesFullList(): void
    {
        $data = $this->subject->findAll();

        self::assertSame(249, count($data));
        self::assertInstanceOf(Country::class, $data['US']);
        self::assertSame('United States', $data['US']->getCommonName());
    }

    /**
     * @test
     */
    public function findByIsoAlpha3ReturnsCorrectCountry(): void
    {
        $expectedCommonName = 'Canada';
        $expectedOfficialName = 'Canada';
        $expectedContinent = 'North America';
        $expectedTLD = 'ca';

        $isoAlpha3 = 'CAN';

        $result = $this->subject->findByIsoAlpha3($isoAlpha3);

        self::assertInstanceOf(Country::class, $result);
        self::assertSame($expectedCommonName, $result->getCommonName());
        self::assertSame($expectedOfficialName, $result->getOfficialName());
        self::assertSame($expectedContinent, $result->getContinent());
        self::assertSame($expectedTLD, $result->getTopLevelDomain());
    }

    /**
     * @test
     */
    public function findByIsoAlpha3WithInvalidIsoAlpha3ThrowsException(): void
    {
        $this->expectExceptionObject(
            new RecordNotFoundException('Cannot find country with isoAlpha3 XYZ')
        );
        $this->subject->findByIsoAlpha3('XYZ');
    }

    /**
     * @test
     */
    public function hasWithIsoAlphaFoundValidCountry(): void
    {
        $validIsoAlpha3Code = 'USA';

        self::assertSame(true, $this->subject->hasWithIsoAlpha3($validIsoAlpha3Code));
    }

    /**
     * @test
     */
    public function hasWithIsoAlphaNotFoundInvalidCountry(): void
    {
        $invalidIsoAlpha3Code = 'USE';

        self::assertSame(false, $this->subject->hasWithIsoAlpha3($invalidIsoAlpha3Code));
    }
}
