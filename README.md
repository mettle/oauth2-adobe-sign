# Adobe Sign Provider for OAuth 2.0 Client

https://acrobat.adobe.com/us/en/sign.html

This package provides Adobe Sign OAuth 2.0 support for The PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

[![Latest Stable Version](https://poser.pugx.org/kevinem/oauth2-adobe-sign/v/stable?format=flat-square)](https://packagist.org/packages/kevinem/oauth2-adobe-sign)
[![License](https://poser.pugx.org/kevinem/oauth2-adobe-sign/license?format=flat-square)](https://packagist.org/packages/kevinem/oauth2-adobe-sign)
[![Build Status](https://travis-ci.org/kevinem/oauth2-adobe-sign.svg?branch=master)](https://travis-ci.org/kevinem/oauth2-adobe-sign)

## Installation

To install, use composer:

```
composer require kevinem/oauth2-adobe-sign
```

## Usage

Use [The League's OAuth2 Client](https://github.com/thephpleague/oauth2-client) with `\KevinEm\OAuth2\Client\AdobeSign` as the provider.

### Authorization Code Flow

```php
$provider = new KevinEm\OAuth2\Client\AdobeSign([
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