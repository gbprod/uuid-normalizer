# Contributing

Thank you for taking time to help.

 * Code contributions must be done in respect of [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md). Scrutinizer will validate this.
 * All changes must be documented in the [CHANGELOG.md](https://github.com/gbprod/uuid-normalizer/blob/master/CHANGELOG.md) in respect of [Keep a Changelog](http://keepachangelog.com/) Standard.
 * Please create an issue before creating a pull request.
 * All code must be covered by tests.
 * Pull requests are made to master. Changes are never pushed directly (without pull request) into master.
 * Use a feature branch for every pull request. Don't open a pull request from your master branch.

## Setup

You should have `php >= 5.6` and `composer` installed (Docker contribution is very welcomed).

Setup you're environment:
```bash
make install
```

Run tests:
```bash
make test-unit
```

Coverage:
```bash
make test-coverage
```
