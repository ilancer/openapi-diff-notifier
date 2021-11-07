<?php

namespace App\Message;

final class SendNotifyMessage
{
    private string $chatId;

    private string $message;

    /**
     * @param string $chatId
     * @param string $message
     */
    public function __construct(string $chatId, string $message)
    {
        $this->chatId = $chatId;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getChatId(): string
    {
        return $this->chatId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
