<?php

declare(strict_types=1);

namespace Country;

use InvalidArgumentException;
use function mb_strlen;

class Country
{
    private $isoAlpha2;

    private $isoAlpha3;

    private $isoNumeric;

    private $commonName;

    private $officialName;

    private $continent;

    private $longDistancePrefix;

    private $topLevelDomain;

    private $currencyIsoAlphaCode;

    public function __construct(
        string $isoAlpha2,
        string $isoAlpha3,
        int $isoNumeric,
        string $commonName,
        string $officialName,
        string $continent,
        int $longDistancePrefix,
        string $topLevelDomain,
        string $currencyIsoAlphaCode
    ) {
        if (mb_strlen($isoAlpha2) !== 2) {
            throw new InvalidArgumentException('IsoAlpha2 must be a 2 character string');
        }

        if (mb_strlen($isoAlpha3) !== 3) {
            throw new InvalidArgumentException('IsoAlpha3 must be a 3 character string');
        }

        $this->isoAlpha2 = $isoAlpha2;
        $this->isoAlpha3 = $isoAlpha3;
        $this->isoNumeric = $isoNumeric;
        $this->commonName = $commonName;
        $this->officialName = $officialName;
        $this->continent = $continent;
        $this->longDistancePrefix = $longDistancePrefix;
        $this->topLevelDomain = $topLevelDomain;
        $this->currencyIsoAlphaCode = $currencyIsoAlphaCode;
    }

    public function __toString(): string
    {
        return $this->isoAlpha2;
    }

    public function getIsoAlpha2(): string
    {
        return $this->isoAlpha2;
    }

    public function getCommonName(): string
    {
        return $this->commonName;
    }

    public function getOfficialName(): string
    {
        return $this->officialName;
    }

    public function getContinent(): string
    {
        return $this->continent;
    }

    public function getIsoAlpha3(): string
    {
        return $this->isoAlpha3;
    }

    public function getLongDistancePrefix(): int
    {
        return $this->longDistancePrefix;
    }

    public function getTopLevelDomain(): string
    {
        return $this->topLevelDomain;
    }

    public function getIsoNumeric(): int
    {
        return $this->isoNumeric;
    }

    public function getCurrencyIsoAlphaCode(): string
    {
        return $this->currencyIsoAlphaCode;
    }

    public function equals(self $country): bool
    {
        return $this->isoAlpha2 === $country->isoAlpha2;
    }
}
