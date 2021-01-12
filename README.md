# Adobe Sign Provider for OAuth 2.0 Client

https://acrobat.adobe.com/us/en/sign.html

This package provides Adobe Sign OAuth 2.0 support for The PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

[![Source Code](https://img.shields.io/badge/source-mettle/oauth2--adobe--sign-blue.svg?style=flat-square)](https://github.com/mettle/oauth2-adobe-sign)
[![Latest Version](https://img.shields.io/github/release/mettle/oauth2-adobe-sign.svg?style=flat-square)](https://github.com/mettle/oauth2-adobe-sign/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/mettle/oauth2-adobe-sign/blob/master/LICENSE)
[![Build Status](https://img.shields.io/github/workflow/status/mettle/oauth2-adobe-sign/CI?label=CI&logo=github&style=flat-square)](https://github.com/mettle/oauth2-adobe-sign/actions?query=workflow%3ACI)

## Requirements

The following versions of PHP are supported:

* PHP 8.0
* PHP 7.4
* PHP 7.3

## Installation

To install, use composer:

```
composer require mettle/oauth2-adobe-sign
```

## Usage

Use [The League's OAuth2 Client](https://github.com/thephpleague/oauth2-client) with `\Mettle\OAuth2\Client\AdobeSign` as the provider.

### Authorization Code Flow

```php
$provider = new Mettle\OAuth2\Client\AdobeSign([
    'clientId'          => 'your_client_id',
    'clientSecret'      => 'your_client_secret',
    'redirectUri'       => 'your_callback',
    'dataCenter'        => 'secure.na1',
    'scope'             => [
          'scope1:type',
          'scope2:type'
    ]
]);
```

## License 

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.