# README

## Description

[composer](https://getcomposer.org/) utils class.

## Contents

- `\Aetonsi\Utils\Composer` class
  - `postAutoloadDump()` function, can be used as `post-autoload-dump` script

## Functions usage as `composer.json` script

```json
{
  "scripts": {
    "post-autoload-dump": ["\\Aetonsi\\Utils\\Composer::postAutoloadDump"]
  }
}
```
