<?php

namespace Country;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    /**
     * @test
     */
    public function invalidConstructionThrowsException(): void
    {
        $isoAlpha2 = 'ZZ';
        $isoAlpha3 = 'XYZ';
        $isoNumeric = 9999;
        $commonName = 'Common Name';
        $officialName = 'Official Name';
        $continent = 'Asia';
        $topLevelDomain = 'tld';
        $longDistancePrefix = 99;
        $currencyIsoAlpha = 'XYD';

        $this->expectException(InvalidArgumentException::class);
        new Country(
            $isoAlpha3,
            $isoAlpha3,
            $isoNumeric,
            $commonName,
            $officialName,
            $continent,
            $longDistancePrefix,
            $topLevelDomain,
            $currencyIsoAlpha
        );

        $this->expectException(InvalidArgumentException::class);
        new Country(
            $isoAlpha2,
            $isoAlpha2,
            $isoNumeric,
            $commonName,
            $officialName,
            $continent,
            $longDistancePrefix,
            $topLevelDomain,
            $currencyIsoAlpha
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
}
