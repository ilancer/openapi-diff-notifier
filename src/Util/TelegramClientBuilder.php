<?php

namespace App\Util;

use TelegramBot\Api\BotApi;

class TelegramClientBuilder
{
    private BotApi $client;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->client = new BotApi($token);
    }

    /**
     * @return BotApi
     */
    public function getClient(): BotApi
    {
        return $this->client;
    }
}
