<?php

namespace Parcelex\Endpoints;

use Parcelex\Routes;

class Checkout extends Endpoint
{

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function preview(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::checkout()->preview(),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function authorize(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::checkout()->authorize(),
            ['json' => $payload]
        );
    }
}
