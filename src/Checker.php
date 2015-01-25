<?php

/*
 * This file is part of the dosten/disposable-email-checker library.
 *
 * (c) Diego Saint Esteben <diego@saintesteben.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DisposableEmailChecker;

use DisposableEmailChecker\Exception\InvalidEmailException;
use DisposableEmailChecker\Provider\InMemoryProvider;
use DisposableEmailChecker\Provider\ProviderInterface;

class Checker
{
    private $provider;

    public function __construct(ProviderInterface $provider = null)
    {
        $this->provider = $provider ?: new InMemoryProvider();
    }

    public function check($email)
    {
        $email = strtolower($email);

        if (!preg_match('/.+\@.+\..+/', $email)) {
            throw new InvalidEmailException('The provided value is not a valid email address.');
        }

        return $this->provider->check($email);
    }
}
