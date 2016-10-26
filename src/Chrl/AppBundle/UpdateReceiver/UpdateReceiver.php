<?php

namespace Chrl\AppBundle\UpdateReceiver;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\Service\GameService;
use Chrl\AppBundle\Type\Update;
use Doctrine\ORM\EntityManagerInterface;

class UpdateReceiver implements UpdateReceiverInterface
{

    private $config;
    private $telegramBotApi;
    private $entityManager;

    private $gameService;

    public function __construct(
        BuktopuhaBotApi $telegramBotApi,
        $config,
        EntityManagerInterface $entityManager,
        GameService $gameService
    ) {
    
        $this->telegramBotApi = $telegramBotApi;
        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->gameService = $gameService;
    }

    public function handleUpdate(Update $update)
    {
        $message = json_decode(json_encode($update->message), true);
        $user = $this->gameService->getCurrentUser($message);
        $this->telegramBotApi->sendMessage(
            $message['chat']['id'],
            '@'.$user->getAlias().', hello from '.$this->config['bot_name']
        );
    }
}
