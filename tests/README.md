# Writing Tests with PestPHP

## Introduction

Welcome to the documentation on writing tests with PestPHP! Pest is a delightful PHP testing framework with a focus on simplicity. This guide will walk you through the process of writing tests using PestPHP, covering various aspects of testing your PHP applications.

## Getting Started

To start writing tests with PestPHP, ensure that you have Pest installed in your PHP project. You can install PestPHP using Composer:

```bash
composer require pestphp/pest --dev
```

Once installed, you can create test files with the `.pest.php` extension in your project's `tests` directory.

## Writing Tests

PestPHP provides a clean and expressive syntax for writing tests, making it easy to describe the behavior of your code. Here are some key concepts and features of writing tests with PestPHP:

- **Describe and It**: Use the `describe` and `it` functions to define test suites and individual tests. Describe blocks provide context for your tests, while `it` blocks define specific test cases.

  ```php
  describe('Math operations', function () {
      it('adds two numbers', function () {
          expect(1 + 1)->toBe(2);
      });
  });
  ```

- **Expectations**: Use the `expect` function to create expectations and make assertions about your code's behavior. PestPHP provides a wide range of matchers to validate different types of values.

  ```php
  it('checks if a value is equal to 10', function () {
      expect(10)->toBe(10);
  });
  ```

- **Helpers and Assertions**: PestPHP provides various helper functions and assertions to simplify your test code. These include `assertTrue`, `assertFalse`, `assertNotNull`, `assertCount`, and many more.

  ```php
  it('checks if a value is true', function () {
      assertTrue(true);
  });
  ```

- **Setup and Teardown**: Use `beforeEach` and `afterEach` functions to run setup and teardown logic before and after each test, respectively.

  ```php
  beforeEach(function () {
      // Setup logic
  });

  afterEach(function () {
      // Teardown logic
  });
  ```

## Further Reading

For more detailed information on writing tests with PestPHP, refer to the official Pest documentation:

- [PestPHP Documentation](https://pestphp.com/docs/writing-tests/)
- [PestPHP GitHub Repository](https://github.com/pestphp/pest)
