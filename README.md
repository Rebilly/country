[![Coverage Status](https://coveralls.io/repos/github/Rebilly/country/badge.svg?branch=master)](https://coveralls.io/github/Rebilly/country?branch=master)

# Country Project

## Overview

This project manages Country information as Value Objects.

## Installation

Simply add a dependency on `rebilly/country` to your project's `composer.json` file if you use [Composer](https://getcomposer.org/) to manage the dependencies of your project.


## Classes / Objects
#### Country

A value object representing a country.

The identifiers are ISO 3166-1 codes (alphabetic and numeric).

The currency values used are ISO 4217 codes.


#### CountryRepository

The Repository contains a collection of Country objects with the ability to find
Countries based on several of the attributes.


#### AdministrativeArea

A value object representing a province/state/territory/region.
Because there is inconsistent naming from country to country, we use the term
Administrative Area.

The identifiers are ISO 3166-2 codes (alphabetic and numeric).


#### AdministrativeAreaRepository

The Repository contains a collection of AdministrativeArea objects with the ability
to find AdministrativeAreas based on several of the attributes or by Country.


## Usage
```php
use Country\AdministrativeAreaRepository;
use Country\CountryRepository;

$countryRepository = new CountryRepository();
$administrativeAreaRepository = new AdministrativeAreaRepository($countryRepository);

// get a list of all countries
$countries = $countryRepository->findAll();

if ($countryRepository->hasWithIsoAlpha2('US')) {
    $usa = $countryRepository->findByIsoAlpha2('US');
    echo $usa->getCommonName(); // United States
    echo $usa->getOfficialName(); // United States of America

    // get a list of all US states
    $administrativeAreaRepository->findByCountry($usa);

    if ($administrativeAreaRepository->hasWithNameAndCountry('New York', $usa)) {
        $newYork = $administrativeAreaRepository->findByNameAndCountry('New York', $usa);
        echo $newYork->getCode(); // NY
    }
}
```

## Tests

```
phpunit
```

## Security

If you discover a security vulnerability, please report it to security at rebilly dot com.

## License

The Country library is open-sourced under the [MIT License](./LICENSE) distributed with the software. 
