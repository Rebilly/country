<?php

declare(strict_types=1);

namespace Country;

class AdministrativeArea
{
    private $code;

    private $name;

    private $country;

    public function __construct(string $code, string $name, Country $country)
    {
        $this->code = $code;
        $this->name = $name;
        $this->country = $country;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function equals(self $administrativeArea): bool
    {
        return
            $this->country->equals($administrativeArea->country)
            && $this->code === $administrativeArea->code;
    }
}
