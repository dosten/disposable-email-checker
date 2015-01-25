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

interface ProviderInterface
{
    public function check($email);
}
