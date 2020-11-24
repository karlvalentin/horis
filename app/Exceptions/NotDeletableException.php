<?php


namespace App\Exceptions;

/**
 * Not deletable exception.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class NotDeletableException extends \LogicException
{
    protected $message = 'Entity is not deletable.';
}
