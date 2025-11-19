# Contributing to Laravel XML & JSON Helpers

First off, thank you for considering contributing to **Laravel XML & JSON Helpers**! It's people like you that make this library such a great tool.

## Code of Conduct

This project and everyone participating in it is governed by our Code of Conduct. By participating, you are expected to uphold this code.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps which reproduce the problem** in as many details as possible
- **Provide specific examples to demonstrate the steps**
- **Describe the behavior you observed after following the steps** and point out what exactly is the problem with that behavior
- **Explain which behavior you expected to see instead and why**
- **Include screenshots and animated GIFs** if possible
- **Include your environment details** (PHP version, Laravel version, OS, etc.)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- **Use a clear and descriptive title**
- **Provide a step-by-step description** of the suggested enhancement
- **Provide specific examples to demonstrate the steps**
- **Describe the current behavior** and **explain the expected behavior**
- **Explain why this enhancement would be useful**
- **List some other packages or libraries** where this enhancement exists, if applicable

### Pull Requests

- Fill in the required template
- Follow the PHP styleguides (PSR-12)
- Include appropriate test cases
- Update documentation as needed
- End all files with a newline

## Development Setup

1. **Fork the repository** and clone it locally
2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Create a feature branch**:
   ```bash
   git checkout -b feature/your-feature-name
   ```

4. **Make your changes** and test them thoroughly
5. **Run tests** to ensure everything works:
   ```bash
   composer test
   ```

6. **Commit your changes** with clear, descriptive messages:
   ```bash
   git commit -m "Add feature: description of your changes"
   ```

7. **Push to your fork** and submit a pull request

## Styleguides

### Git Commit Messages

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to 72 characters or less
- Reference issues and pull requests liberally after the first line
- Example:
  ```
  Add XML attribute support

  This adds support for XML attributes when converting arrays to XML.
  Fixes #123
  ```

### PHP Code Style

We follow [PSR-12 Extended Coding Style](https://www.php-fig.org/psr/psr-12/):

- Indentation must be 4 spaces
- Lines should not exceed 120 characters
- Use meaningful variable and function names
- Add PHPDoc comments for classes and methods
- Example:

```php
<?php

namespace Larataj\XmlHelpers;

/**
 * Class ResponseHelper
 *
 * Handles conversion between arrays and XML
 *
 * @package Larataj\XmlHelpers
 */
class ResponseHelper
{
    /**
     * Convert array to XML string
     *
     * @param array $data The data to convert
     * @param string $rootElement The root element name
     * @return string
     */
    public static function arrayToXml(array $data, string $rootElement = 'response'): string
    {
        // Implementation here
    }
}
```

### Documentation Style

- Use clear, simple English
- Include code examples for new features
- Keep the README.md up to date
- Update CHANGELOG.md with your changes
- Comment complex logic in the code

## Additional Notes

### Issue and Pull Request Labels

- `bug` — Something isn't working
- `enhancement` — New feature or request
- `documentation` — Improvements or additions to documentation
- `good first issue` — Good for newcomers
- `help wanted` — Extra attention is needed
- `question` — Further information is requested

## Testing

Before submitting a pull request, please ensure:

1. Your code passes all existing tests
2. You've added tests for any new functionality
3. All tests pass locally:
   ```bash
   composer test
   ```

## Questions?

Feel free to open an issue with the `question` label if you have any questions about contributing or using the package.

## License

By contributing to **Laravel XML & JSON Helpers**, you agree that your contributions will be licensed under the same MIT License that covers the project.

---

**Thank you for contributing!** 🚀