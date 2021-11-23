<?php

namespace Parcelex\Endpoints;

use Parcelex\Client;

abstract class Endpoint
{
    /**
     * @var string
     */
    const POST = 'POST';
    /**
     * @var string
     */
    const GET = 'GET';
    /**
     * @var string
     */
    const PUT = 'PUT';
    /**
     * @var string
     */
    const DELETE = 'DELETE';

    /**
     * @var \Parcelex\Client
     */
    protected $client;

    /**
     * @param \Parcelex\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
