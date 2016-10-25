<?php

namespace Chrl\AppBundle\UpdateReceiver;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\Entity\Game;
use Chrl\AppBundle\Entity\User;
use Chrl\AppBundle\Type\Update;
use Doctrine\ORM\EntityManagerInterface;

class UpdateReceiver implements UpdateReceiverInterface
{

    private $config;
    private $telegramBotApi;
    private $entityManager;

    public function __construct(BuktopuhaBotApi $telegramBotApi, $config, EntityManagerInterface $entityManager)
    {
        $this->telegramBotApi = $telegramBotApi;
        $this->config = $config;
        $this->entityManager = $entityManager;
    }

    public function handleUpdate(Update $update)
    {
        $message = json_decode(json_encode($update->message), true);
        $user = $this->getCurrentUser($message);
        $this->telegramBotApi->sendMessage(
            $message['chat']['id'],
            '@'.$user->getAlias().', hello from '.$this->config['bot_name']
        );
    }

    public function findGame(array $message)
    {
        $game = $this->entityManager->getRepository('AppBundle:Game')->findOneBy(['chatId'=>$message['chat']['id']]);
        if (!$game) {
            // create game
            $game = new Game();
            $game->status = 0;
            $game->chatId = $message['chat']['id'];
            $game->title = isset($message['chat']['title'])
                                ? $message['chat']['title']
                                : 'No title';

            $this->entityManager->persist($game);
            $this->entityManager->flush();
        }
        return $game;
    }


    public function getCurrentUser(array $message)
    {
        $user = $this->entityManager->getRepository('AppBundle:User')->findOneBy(['tgId'=>$message['from']['id']]);
        if (!$user) {
            $user = new User();
            $user->setName($message['from']['first_name'].' '.$message['from']['last_name']);
            $user->setAlias($message['from']['username']);
            $user->setTgId($message['from']['id']);
            $user->setGame($this->findGame($message));
            $user->setChatId($message['chat']['id']);
            $user->setPoints(0);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
        return $user;
    }
}
