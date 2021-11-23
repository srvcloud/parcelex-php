<?php

namespace Parcelex;

use Parcelex\Anonymous;

class Routes
{

    /**
     * @return \Parcelex\Anonymous
     */
    public static function checkout()
    {
        $anonymous = new Anonymous();

        $anonymous->preview = static function () {
            return 'preview';
        };

        $anonymous->authorize = static function () {
            return 'authorize';
        };

        return $anonymous;
    }

    /**
     * @return \Parcelex\Anonymous
     */
    public static function transaction()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function ($transactionId) {
            return "transaction/$transactionId";
        };

        $anonymous->status = static function ($transactionId) {
            return "/transaction/$transactionId/status";
        };

        return $anonymous;
    }
}
