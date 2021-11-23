<?php

namespace Parcelex;

use GuzzleHttp\Exception\ClientException;
use Parcelex\Exceptions\ParcelexException;
use Parcelex\Exceptions\InvalidJsonException;

class ResponseHandler
{

    /**
     * @param string $payload
     *
     * @throws \Parcelex\Exceptions\InvalidJsonException
     * @return \ArrayObject
     */
    public static function success($payload)
    {
        if (empty($payload)) {
            return null;
        }
        return self::toJson($payload);
    }

    /**
     * @param ClientException $originalException
     *
     * @throws ParcelexException
     * @return void
     */
    public static function failure(\Exception $originalException)
    {
        throw self::parseException($originalException);
    }

    /**
     * @param ClientException $guzzleException
     *
     * @return ParcelexException|ClientException
     */
    private static function parseException(ClientException $guzzleException)
    {

        $response = $guzzleException->getResponse();

        if (is_null($response)) {
            return $guzzleException;
        }

        $body = $response->getBody()->getContents();

        return new ParcelexException($body);
    }

    /**
     * @param string $json
     * @return \ArrayObject
     */
    private static function toJson($json)
    {
        $result = json_decode($json);

        if (json_last_error() != \JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg());
        }

        return $result;
    }
}
