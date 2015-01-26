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

class ChainProvider implements ProviderInterface
{
    private $providers = array();

    public function __construct(array $providers = array())
    {
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    public function check($email)
    {
        foreach ($this->providers as $provider) {
            if ($provider->check($email)) {
                return true;
            }
        }

        return false;
    }
}
