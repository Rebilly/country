<?php

namespace Country;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideInvalidData
     */
    public function invalidConstructionThrowsException(array $data, array $expected): void
    {
        $this->expectException($expected[0]);
        $this->expectExceptionMessage($expected[1]);
        new Country(
            $data['isoAlpha2'],
            $data['isoAlpha3'],
            9999,
            'Common Name',
            'Official Name',
            'Asia',
            99,
            'tld',
            'XYD'
        );
    }

    /**
     * @test
     */
    public function construction(): void
    {
        $isoAlpha2 = 'XY';
        $isoAlpha3 = 'XYZ';
        $isoNumeric = 9999;
        $commonName = 'Common Name';
        $officialName = 'Official Name';
        $continent = 'Asia';
        $topLevelDomain = 'tld';
        $longDistancePrefix = 99;
        $currencyIsoAlpha = 'XYD';

        $country = new Country(
            $isoAlpha2,
            $isoAlpha3,
            $isoNumeric,
            $commonName,
            $officialName,
            $continent,
            $longDistancePrefix,
            $topLevelDomain,
            $currencyIsoAlpha
        );
        $this->assertInstanceOf(Country::class, $country);
        $this->assertSame($isoAlpha2, $country->getIsoAlpha2());
        $this->assertSame($isoAlpha3, $country->getIsoAlpha3());
        $this->assertSame($isoAlpha2, (string) $country);
        $this->assertSame($longDistancePrefix, $country->getLongDistancePrefix());
        $this->assertSame($isoNumeric, $country->getIsoNumeric());
        $this->assertSame($currencyIsoAlpha, $country->getCurrencyIsoAlphaCode());
    }

    /**
     * @test
     */
    public function equals(): void
    {
        $isoAlpha2 = 'CA';
        $isoAlpha3 = 'CAN';
        $isoNumeric = 840;
        $commonName = 'Canada';
        $officialName = 'Canada';
        $continent = 'North America';
        $topLevelDomain = 'ca';
        $longDistancePrefix = 1;
        $currencyIsoAlpha = 'CAD';

        $country = new Country(
            $isoAlpha2,
            $isoAlpha3,
            $isoNumeric,
            $commonName,
            $officialName,
            $continent,
            $longDistancePrefix,
            $topLevelDomain,
            $currencyIsoAlpha
        );

        $canada = new Country(
            $isoAlpha2,
            $isoAlpha3,
            $isoNumeric,
            $commonName,
            $officialName,
            $continent,
            $longDistancePrefix,
            $topLevelDomain,
            $currencyIsoAlpha
        );

        $this->assertTrue($country->equals($canada));
    }

    public function provideInvalidData(): array
    {
        return [
            [
                ['isoAlpha2' => 'USA', 'isoAlpha3' => 'USA'],
                [InvalidArgumentException::class, 'IsoAlpha2 must be a 2 character string']
            ],
            [
                ['isoAlpha2' => 'US', 'isoAlpha3'  => 'US'],
                [InvalidArgumentException::class, 'IsoAlpha3 must be a 3 character string']
            ],
        ];
    }
}
