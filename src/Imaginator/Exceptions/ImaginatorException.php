<?php

namespace eig\Imaginator\Exceptions;

/**
 * Class ImaginatorException
 * @package eig\Imaginator\Exceptions
 * @codeCoverageIgnore
 */
class ImaginatorException extends \Exception
{
    /**
     * @param string                                      $message
     * @param int                                         $code
     * @param \Exception|null                             $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    /**
     * __toString
     * @return string
     */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
