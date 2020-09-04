<?php
declare(strict_types=1);

namespace Country;

/**
 * A repository of Administrative Area Value Objects.
 *
 * AdministrativeArea corresponds to the state, province,
 * region, or other similarly defined area.
 *
 * The name is borrowed from geonames.
 */
class AdministrativeAreaRepository
{
    private const ADMINISTRATIVE_AREAS = [
        'US' => [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AS' => 'American Samoa',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'GU' => 'Guam',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'MP' => 'Northern Mariana Islands',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'PR' => 'Puerto Rico',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UM' => 'U.S. Minor Outlying Islands',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VI' => 'Virgin Islands of the U.S.',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WI' => 'Wisconsin',
            'WV' => 'West Virginia',
            'WY' => 'Wyoming',
        ],
        'GB' => [
            'EN' => 'England',
            'SC' => 'Scotland',
            'NO' => 'Northern Ireland',
            'WA' => 'Wales',
        ],
        'CA' => [
            'AB' => 'Alberta',
            'BC' => 'British Columbia',
            'MB' => 'Manitoba',
            'NB' => 'New Brunswick',
            'NL' => 'Newfoundland and Labrador',
            'NT' => 'Northwest Territories',
            'NS' => 'Nova Scotia',
            'NU' => 'Nunavut',
            'ON' => 'Ontario',
            'PE' => 'Prince Edward Island',
            'QC' => 'Québec',
            'SK' => 'Saskatchewan',
            'YT' => 'Yukon',
        ],
        'IE' => [
            'CE' => 'Clare',
            'LM' => 'Leitrim',
            'CK' => 'Cork',
            'LS' => 'Laois',
            'CN' => 'Cavan',
            'MH' => 'Meath',
            'CW' => 'Carlow',
            'MN' => 'Monaghan',
            'DL' => 'Donegal',
            'MO' => 'Mayo',
            'DN' => 'Dublin',
            'OY' => 'Offaly',
            'GY' => 'Galway',
            'RN' => 'Roscommon',
            'KE' => 'Kildare',
            'SO' => 'Sligo',
            'KK' => 'Kilkenny',
            'TY' => 'Tipperary',
            'KY' => 'Kerry',
            'WD' => 'Waterford',
            'LD' => 'Longford',
            'WH' => 'Westmeath',
            'LH' => 'Louth',
            'WW' => 'Wicklow',
            'LK' => 'Limerick',
            'WX' => 'Wexford',
        ],
        'AU' => [
            'NSW' => 'New South Wales',
            'QLD' => 'Queensland',
            'SA' => 'South Australia',
            'TAS' => 'Tasmania',
            'VIC' => 'Victoria',
            'WA' => 'Western Australia',
        ],
    ];

    private const NAME_ALIASES = [
        ['countryCode' => 'CA', 'code' => 'QC', 'alias' => 'Quebec'],
    ];

    /**
     * @var array 2 dimensional array of AdministrativeAreas keyed by Country, then by Code
     */
    private $administrativeAreasByCountryAndCode = [];

    /**
     * @var array 2 dimensional array of AdministrativeAreas keyed by Country, then by Name
     */
    private $administrativeAreasByCountryAndName = [];

    public function __construct(CountryRepository $countryRepository)
    {
        foreach (self::ADMINISTRATIVE_AREAS as $countryCode => $areas) {
            $country = $countryRepository->findByIsoAlpha2($countryCode);
            $this->populateAdministrativeAreas($country, $areas);
        }

        $this->populateAliases();
    }

    public function findByNameAndCountry(string $name, Country $country): AdministrativeArea
    {
        if (!$this->hasWithNameAndCountry($name, $country)) {
            throw new RecordNotFoundException(
                sprintf('%s was not found in Country %s', $name, $country->getIsoAlpha2())
            );
        }
        $countryIsoAlpha2 = $country->getIsoAlpha2();

        return $this->administrativeAreasByCountryAndName[$countryIsoAlpha2][$name];
    }

    public function hasWithNameAndCountry(string $name, Country $country): bool
    {
        $countryCode = $country->getIsoAlpha2();

        return !empty($this->administrativeAreasByCountryAndName[$countryCode][$name]);
    }

    /**
     * Retrieve a list of areas for a country code.
     *
     * @return Country[]
     */
    public function findByCountry(Country $country): array
    {
        $countryCode = $country->getIsoAlpha2();

        return $this->administrativeAreasByCountryAndCode[$countryCode] ?? [];
    }

    private function populateAdministrativeAreas(Country $country, array $areas): void
    {
        $countryCode = $country->getIsoAlpha2();
        $this->administrativeAreasByCountryAndCode[$countryCode] = [];
        $this->administrativeAreasByCountryAndName[$countryCode] = [];

        foreach ($areas as $code => $name) {
            $administrativeArea = new AdministrativeArea($code, $name, $country);

            $this->administrativeAreasByCountryAndCode[$countryCode][$code] = $administrativeArea;
            $this->administrativeAreasByCountryAndName[$countryCode][$name] = $administrativeArea;
        }
    }

    private function populateAliases(): void
    {
        foreach (self::NAME_ALIASES as $nameAlias) {
            $countryCode = $nameAlias['countryCode'];
            $code = $nameAlias['code'];
            $alias = $nameAlias['alias'];

            $administrativeArea = $this->administrativeAreasByCountryAndCode[$countryCode][$code];
            $this->administrativeAreasByCountryAndName[$countryCode][$alias] = $administrativeArea;
        }
    }
}
