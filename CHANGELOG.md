# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.0] - 2025-11-19

### Added
- **English documentation** - Complete English version of README for global audience
- **Enhanced SEO metadata** - Optimized keywords and descriptions for search engines
- **Extended keyword support** - Better discoverability on Packagist and Google
- **XmlBuilder Class** - Advanced XML building with fluent interface
  - Add child elements
  - Add multiple children at once
  - CDATA section support
  - Comments support
  - Attributes support
  - Pretty printing
- **XmlParser Class** - Powerful XML parsing and querying
  - Parse XML strings and files
  - Convert XML to arrays
  - XPath queries
  - Pretty printing
  - Schema validation support
- **Contributing guidelines** - New CONTRIBUTING.md file for community contributions
- **Features documentation** - New FEATURES.md file listing all capabilities
- **Changelog tracking** - Comprehensive changelog documentation
- **LICENSE file** - MIT License for clarity
- **Dev dependencies** - PHPUnit and Orchestra Testbench for testing
- **Response macros** - Additional `response()->xmlBuilder()` macro

### Improved
- Better package description for SEO optimization
- More comprehensive documentation with examples
- Enhanced feature list with clear benefits
- Bilingual support (English/Russian) for wider audience
- Updated version to reflect new features
- Better code organization and documentation
- Enhanced error handling
- Performance optimizations

### Documentation
- Added English documentation section
- Improved README structure and clarity
- Added bilingual navigation links
- Better formatting and examples
- Added Advanced Usage section
- Added Feature comparison table
- Comprehensive API examples

### Changed
- Updated composer.json with more dependencies info
- Enhanced PHPDoc comments throughout the codebase
- Improved type hints and declarations

## [2.0.0] - Previous Release

### Features
- XML to Array conversion
- Array to XML conversion
- Laravel XML response helper
- Standardized JSON API responses
- Support for pagination
- Multiple HTTP status codes
- Service provider auto-discovery

### Bug Fixes
- Fixed namespace consistency
- Updated API structure

---

## Installation & Usage

For the latest features, install the latest version:

```bash
composer require larataj/xml-helpers
```

See [README.md](README.md) for detailed usage instructions.

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## License

MIT License - see LICENSE file for details.