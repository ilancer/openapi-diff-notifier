<?php

namespace App\MessageHandler;

use App\Message\SendNotifyMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendNotifyMessageHandler implements MessageHandlerInterface
{
    /**
     * @param SendNotifyMessage $message
     */
    public function __invoke(SendNotifyMessage $message): void
    {
        // todo: implement
        throw new \Exception('Not implemented yet');
    }
}
