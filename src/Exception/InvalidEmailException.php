<?php

/*
 * This file is part of the dosten/disposable-email-checker library.
 *
 * (c) Diego Saint Esteben <diego@saintesteben.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DisposableEmailChecker\Exception;

/**
 * Exception thrown when an invalid email is provided.
 *
 * @author Diego Saint Esteben <diego@saintesteben.me>
 */
class InvalidEmailException extends \InvalidArgumentException
{
}
