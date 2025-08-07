<?php

namespace Convoflo\SocialiteProvider;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase('https://api.convoflo.com/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl(): string
    {
        return 'https://api.convoflo.com/oauth/token';
    }

    /**
     * {@inheritdoc}
     * @throws GuzzleException
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.convoflo.com/api/1/account', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user): User
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['ID'],
            'name' => $user['Name'],
            'email' => $user['Email'],
        ]);
    }
}
