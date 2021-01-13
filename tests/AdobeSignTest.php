<?php

declare(strict_types=1);

namespace Mettle\OAuth2\Client\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mettle\OAuth2\Client\AdobeSign;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Class AdobeSignTest
 * @package Mettle\OAuth2\Client\Tests
 */
class AdobeSignTest extends TestCase
{
    /**
     * @var AdobeSign
     */
    protected $provider;

    protected function setUp(): void
    {
        $this->provider = new AdobeSign([
            'clientId' => 'mock_client_id',
            'clientSecret' => 'mock_client_secret',
            'redirectUri' => 'none',
            'scope' => [
                'mock_scope:type'
            ]
        ]);
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        m::close();
        parent::tearDown();
    }

    public function testScopes()
    {
        $options = [
            'scope' => [
                'user_login:account',
                'agreement_send:account'
            ]
        ];

        $url = $this->provider->getAuthorizationUrl($options);

        $this->assertStringContainsString(implode('+', $options['scope']), $url);
    }

    public function testGetAuthorizationUrl()
    {
        $url = $this->provider->getAuthorizationUrl();
        ['host' => $host, 'path' => $path] = parse_url($url);

        $this->assertEquals('secure.na1.echosign.com', $host);
        $this->assertEquals('/public/oauth', $path);
    }

    public function testGetAccessTokenUrl()
    {
        $accessToken = [
            'access_token' => 'mock_access_token'
        ];

        $mock = new MockHandler([
            new Response(200, ['content-type' => 'json'], json_encode($accessToken))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $this->provider->setHttpClient(
            new Client(['handler' => $handlerStack])
        );

        $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);

        $this->assertEquals('mock_access_token', $token->getToken());
    }

    public function testGetAccessTokenUrlForRefreshToken()
    {
        $accessToken = [
            'access_token' => 'mock_access_token'
        ];

        $mock = new MockHandler([
            new Response(200, ['content-type' => 'json'], json_encode($accessToken))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $this->provider->setHttpClient(
            new Client(['handler' => $handlerStack])
        );

        $token = $this->provider->getAccessToken('refresh_token', ['refresh_token' => 'mock_refresh_token']);

        $this->assertEquals('mock_access_token', $token->getToken());
    }

    public function testGetBaseRefreshTokenUrl()
    {
        $this->assertNotNull($this->provider->getBaseRefreshTokenUrl());
    }

    public function testGetResourceOwnerDetailsUrl()
    {
        $accessToken = m::mock('League\OAuth2\Client\Token\AccessToken');
        $res = $this->provider->getResourceOwnerDetailsUrl($accessToken);
        $this->assertNull($res);
    }

    public function testCreateResourceOwner()
    {
        $resourceOwner = [];

        $mock = new MockHandler([
            new Response(200, ['content-type' => 'json'], json_encode($resourceOwner))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $this->provider->setHttpClient(
            new Client(['handler' => $handlerStack])
        );

        $accessToken = m::mock('League\OAuth2\Client\Token\AccessToken');

        $res = $this->provider->getResourceOwner($accessToken);
        $this->assertNull($res);
    }

    public function testDataCenterOption()
    {
        $provider = new AdobeSign([
            'clientId' => 'mock_client_id',
            'clientSecret' => 'mock_client_secret',
            'redirectUri' => 'none',
            'scope' => [
                'mock_scope:type'
            ],
            'dataCenter' => 'api.jp1'
        ]);

        $this->assertEquals('https://api.jp1.echosign.com/public/oauth', $provider->getBaseAuthorizationUrl());
        $this->assertEquals('https://api.jp1.echosign.com/oauth/token', $provider->getBaseAccessTokenUrl([]));
        $this->assertEquals('https://api.jp1.echosign.com/oauth/refresh', $provider->getBaseRefreshTokenUrl());
        $this->assertEquals('https://api.jp1.echosign.com/oauth/revoke', $provider->getBaseRevokeTokenUrl());
    }
}