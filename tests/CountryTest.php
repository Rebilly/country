<?php

declare(strict_types=1);

namespace Country;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CountryTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideInvalidData
     */
    public function invalidConstructionThrowsException(array $data): void
    {
        $this->expectExceptionObject($data['exception']);
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
        self::assertInstanceOf(Country::class, $country);
        self::assertSame($isoAlpha2, $country->getIsoAlpha2());
        self::assertSame($isoAlpha3, $country->getIsoAlpha3());
        self::assertSame($isoAlpha2, (string) $country);
        self::assertSame($longDistancePrefix, $country->getLongDistancePrefix());
        self::assertSame($isoNumeric, $country->getIsoNumeric());
        self::assertSame($currencyIsoAlpha, $country->getCurrencyIsoAlphaCode());
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

        self::assertTrue($country->equals($canada));
    }

    public function provideInvalidData(): array
    {
        return [
            [
                [
                    'isoAlpha2' => 'USA',
                    'isoAlpha3' => 'USA',
                    'exception' => new InvalidArgumentException('IsoAlpha2 must be a 2 character string'),
                ],
            ],
            [
                [
                    'isoAlpha2' => 'US',
                    'isoAlpha3' => 'US',
                    'exception' => new InvalidArgumentException('IsoAlpha3 must be a 3 character string'),
                ],
            ],
        ];
    }
}
