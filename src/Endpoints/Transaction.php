<?php

namespace Parcelex\Endpoints;

use Parcelex\Routes;

class Transaction extends Endpoint
{

    /**
     *
     * @param array $payload
     * @return \ArrayObject
     */
    public function get(array $payload = null)
    {
        return $this->client->request(
            self::POST,
            Routes::transaction()->base($payload['transaction_id']),
            ['json' => $payload]
        );
    }

    /**
     *
     * @param array $payload
     * @return \ArrayObject
     */
    public function status(array $payload = null)
    {

        $transactionId = $payload['transaction_id'];
        unset($payload['transaction_id']);

        return $this->client->request(
            self::POST,
            Routes::transaction()->status($transactionId),
            ['json' => $payload]
        );
    }
}
