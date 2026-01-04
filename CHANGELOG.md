# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2026-01-04

### Added

- Added `make:site` command to generate Site classes.
- Added `make:asset-container` command to generate Asset Container classes.
- Added support for Asset Containers via `BaseAssetContainer`.
- Enhanced support for Global Sets, including repository integration and saving.
- Enhanced support for Navigations, including repository integration.
- Added support for Multi-site through PHP classes.
- Added new field types: `Color`, `Hidden`, `Money`, `Number`, `Password`, `Rating`, `Time`, `Video`.
- Added auto-discovery for all component types.
- Integrated Statamic Eloquent Driver support for Global Sets and Navigations.

### Changed

- Refactored all generator commands to use a common `GeneratorCommand` base class for consistency.
- Improved Blueprint and Fieldset repository integration to better handle PHP-defined components.
- Standardized class naming in generator commands to use `StudlyCase`.

### Fixed

- Improved code style and consistency across the project.
- Fixed Various minor issues with component registration.
