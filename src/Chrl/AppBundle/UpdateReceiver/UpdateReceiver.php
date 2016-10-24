<?php

namespace Chrl\AppBundle\UpdateReceiver;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\Type\Update;

class UpdateReceiver implements UpdateReceiverInterface
{

    private $config;
    private $telegramBotApi;

    public function __construct(BuktopuhaBotApi $telegramBotApi, $config)
    {
        $this->telegramBotApi = $telegramBotApi;
        $this->config = $config;
    }

    public function handleUpdate(Update $update)
    {
        $message = json_decode(json_encode($update->message), true);
        $this->telegramBotApi->sendMessage($message['chat']['id'], 'Hello from '.$this->config['bot_name'].'!');
    }
}
