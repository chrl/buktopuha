<?php

namespace Chrl\AppBundle\UpdateReceiver;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\Entity\Game;
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
		$game = $this->findGame($message);
        $this->telegramBotApi->sendMessage($message['chat']['id'], 'Hello from '.$this->config['bot_name'].' in game "'.$game->title.'"!');
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
}
