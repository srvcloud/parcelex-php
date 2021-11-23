<?php

namespace Parcelex;

use Parcelex\Exceptions\InvalidJsonException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Parcelex\Endpoints\Checkout;
use Parcelex\Endpoints\Transaction;

class Client
{

    /**
     * @var string
     */
    const BASE_URI = 'https://api.parcelex.com.br/public/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $http;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var \Parcelex\Endpoints\Checkout
     */
    private $checkout;

    /**
     * @var \Parcelex\Endpoints\Transaction
     */
    private $transaction;

    /**
     * @param string $apiKey
     * @param array|null $extras
     */
    public function __construct($apiKey, array $extras = null)
    {
        $this->apiKey = $apiKey;

        $options = ['base_uri' => self::BASE_URI];

        if (!is_null($extras)) {
            $options = array_merge($options, $extras);
        }

        $this->http = new HttpClient($options);

        $this->checkout = new Checkout($this);
        $this->transaction = new Transaction($this);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @throws \Parcelex\Exceptions\ParcelexException
     * @return \ArrayObject
     *
     */
    public function request($method, $uri, $options = [])
    {

        try {
            $response = $this->http->request(
                $method,
                $uri,
                RequestHandler::bindApiKeyToBodyParams(
                    $options,
                    $this->apiKey
                )
            );
            return ResponseHandler::success((string)$response->getBody());
        } catch (InvalidJsonException $exception) {
            throw $exception;
        } catch (ClientException $exception) {
            ResponseHandler::failure($exception);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return \Parcelex\Endpoints\Checkout
     */
    public function checkout()
    {
        return $this->checkout;
    }

    /**
     * @return \Parcelex\Endpoints\Transaction
     */
    public function transaction()
    {
        return $this->transaction;
    }
}
