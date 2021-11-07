<?php

namespace App\Command;

use App\Message\SendNotifyMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class FillMessageQueueCommand extends Command
{
    protected static $defaultName = 'app:fill-message-queue';

    private MessageBusInterface $bus;

    /**
     * @required
     *
     * @param MessageBusInterface $bus
     */
    public function setBus(MessageBusInterface $bus): void
    {
        $this->bus = $bus;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new SendNotifyMessage('techno_djihad', 'test'));

        return Command::SUCCESS;
    }
}
