<?php

namespace Parcelex;

class RequestHandler
{

    /**
     * @param array $options
     * @param string $apiKey
     * @return array
     */
    public static function bindApiKeyToBodyParams(array $options, $apiKey)
    {
        $options['json']['apiKey'] = $apiKey;
        return $options;
    }
}
