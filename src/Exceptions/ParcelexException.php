<?php

namespace Parcelex\Exceptions;

final class ParcelexException extends \Exception
{

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @param string $errorMessage
     */
    public function __construct($errorMessage)
    {

        $this->errorMessage = $errorMessage;

        $exceptionMessage = $this->buildExceptionMessage();

        parent::__construct($exceptionMessage);
    }

    /**
     * @return string
     */
    private function buildExceptionMessage()
    {

        $message = [];

        if (!is_null($this->errorMessage)) {
            array_push(
                $message,
                sprintf('MESSAGE: %s', $this->errorMessage)
            );
        }

        return join('. ', $message);
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
