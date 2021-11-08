<?php

namespace App\MessageHandler;

use App\Message\SendNotifyMessage;
use App\Util\TelegramClientBuilder;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use TelegramBot\Api\BotApi;

final class SendNotifyMessageHandler implements MessageHandlerInterface
{
    private BotApi $api;

    /**
     * @param TelegramClientBuilder $telegramClientBuilder
     */
    public function __construct(TelegramClientBuilder $telegramClientBuilder)
    {
        $this->api = $telegramClientBuilder->getClient();
    }

    /**
     * @param SendNotifyMessage $message
     */
    public function __invoke(SendNotifyMessage $message): void
    {
        throw new \Exception('Not implemented yet');
    }
}
