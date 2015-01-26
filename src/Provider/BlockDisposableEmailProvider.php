<?php

/*
 * This file is part of the dosten/disposable-email-checker library.
 *
 * (c) Diego Saint Esteben <diego@saintesteben.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DisposableEmailChecker\Provider;

class BlockDisposableEmailProvider implements ProviderInterface
{
    const HOST = 'check.block-disposable-email.com';
    const ENDPOINT = 'easyapi/json';

    private $apiKey;

    public function __construct($apiKey)
    {
        if (!extension_loaded('curl')) {
            throw new \LogicException('The curl extension is needed to use the BlockDisposableEmailProvider');
        }

        $this->apiKey = $apiKey;
    }

    public function check($email)
    {
        list($local, $domain) = explode('@', $email, 2);

        $result = $this->sendRequest($domain);

        if ('success' !== $result['request_status']) {
            throw new \RuntimeException('The provider failed with the following error: '.$result['request_status']);
        }

        return 'block' === $result['domain_status'];
    }

    protected function sendRequest($domain)
    {
        $ch = curl_init();
        $url = sprintf('http://%s/%s/%s/%s/', self::HOST, self::ENDPOINT, $this->apiKey, $domain);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }
}
