# Change Log
All notable changes to this project will be documented in this file
using the [Keep a CHANGELOG](http://keepachangelog.com/) principles.
This project adheres to [Semantic Versioning](http://semver.org/).

<!--
Types of changes

Added - for new features.
Changed - for changes in existing functionality.
Deprecated - for soon-to-be removed features.
Removed - for now removed features.
Fixed - for any bug fixes.
Security - in case of vulnerabilities.
-->

## 1.1.3 (2023-07-11)

### Fixed

- Fixed PHPDoc return type of `AdministrativeAreaRepository::findByCountry` method

## 1.1.2 (2023-03-07)

### Added

- Added country name aliases for Burma, Cote d'Ivoire, Curacao, Czech Republic, East Timor, Federated States of Micronesia, Netherlands, Palestinian territories, Saint Helena, Ascension and Tristan da Cunha, and United States Virgin Islands
- Added Republic of Kosovo with temporary user-assigned ISO codes

## 1.1.1 (2020-11-02)

### Fixed

- Fixed `iconv` platform compatibility issue

## 1.1.0 (2020-09-04)

### Added

- Added countries aliases for additional known names

### Changed

- Upgrade minimum PHP version to 7.3
- Updated currencies list

### Deprecated

- Deprecated `findByOfficialName` and `findByCommonName` of `CountryRepository`

### Fixed

- Fixed the region of Canada to North America

## 1.0.0 (2018-12-08)

Initial Release
