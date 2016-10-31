<?php

namespace Chrl\AppBundle\UpdateReceiver;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\GameAction\CommandPool;
use Chrl\AppBundle\GameAction\GameActionInterface;
use Chrl\AppBundle\Service\GameService;
use Chrl\AppBundle\Type\Update;
use Doctrine\ORM\EntityManagerInterface;

class UpdateReceiver implements UpdateReceiverInterface
{

    private $config;
    private $telegramBotApi;
    private $entityManager;

    private $gameService;
    private $commandPool;

    public function __construct(
        BuktopuhaBotApi $telegramBotApi,
        $config,
        EntityManagerInterface $entityManager,
        GameService $gameService,
        CommandPool $commandPool
    ) {
    
        $this->telegramBotApi = $telegramBotApi;
        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->gameService = $gameService;
        $this->commandPool = $commandPool;
    }

    public function handleUpdate(Update $update)
    {
        $message = json_decode(json_encode($update->message), true);
        file_put_contents('/tmp/messages.tg.bot', json_encode($message), FILE_APPEND);

        $user = $this->gameService->getCurrentUser($message);


        if (isset($message['text'])) {
            $gameAction = $this->commandPool->setGameService($this->gameService)->findAction($message);

            if (!$gameAction instanceof GameActionInterface) {
                $this->gameService->checkAnswer($message);
                return;
            }

            $gameAction->run($message, $user);
        } else {
            // handle possible joins/lefts
            $this->handleJoin($message);
        }
    }

    public function handleJoin($message)
    {
        if (isset($message['new_chat_participant'])) {
            if ($message['new_chat_participant']['username'] == $this->config['bot_name']) {
                $this->telegramBotApi->sendMessage(
                    $message['chat']['id'],
                    'Thank you for inviting me to the group! Press /start to start the game!'
                );
            } else {
                $this->telegramBotApi->sendMessage(
                    $message['chat']['id'],
                    'Welcome to the group, @'.
                    $message['new_chat_participant']['username'].'! Feel free to join the game!'
                );
            }
        }
    }
}
