# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.0.0] - 2022-07-26
### Changed
- The package is migrated to PHP 8.1

### Removed
- Support for PHP 7 and older versions
- Compound document validation logic is dropped

## [2.2.0] - 2020-10-12
### Added
- `NewResourceObject` to allow omitting `id` in resources to-be-created (#108)

## [2.1.2] - 2020-03-16
### Fixed
- Related links must be allowed inside relationship documents (#104)

## [2.1.1] - 2019-12-19
### Fixed
- `ResourceIdentifier` does not allow multiple meta members (#99)

## [2.1.0] - 2019-02-25
### Fixed
- Relationship without data property (#92)

## [2.0.1] - 2018-12-31
### Changed
- Downgraded min required php version to 7.1

## 2.0.0 - 2018-02-26
### Added
- v2 initial release

[Unreleased]: https://github.com/json-api-php/json-api/compare/3.0.0...HEAD
[3.0.0]: https://github.com/json-api-php/json-api/compare/2.2.2...3.0.0
[2.2.0]: https://github.com/json-api-php/json-api/compare/2.1.2...2.2.0
[2.1.2]: https://github.com/json-api-php/json-api/compare/2.1.1...2.1.2
[2.1.1]: https://github.com/json-api-php/json-api/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/json-api-php/json-api/compare/2.0.1...2.1.0
[2.0.1]: https://github.com/json-api-php/json-api/compare/2.0.0...2.0.1
