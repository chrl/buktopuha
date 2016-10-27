<?php

namespace Chrl\AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Chrl\AppBundle\Entity\Game;
use Chrl\AppBundle\Entity\User;
use Chrl\AppBundle\BuktopuhaBotApi;

/**
 * Game service
 *
 * @category Symfony
 * @package  Chrl_Buktopuha
 * @author   Kirill Kholodilin <charlie@chrl.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://take2.ru/
 */

class GameService
{
    public $em;

    public function __construct(BuktopuhaBotApi $telegramBotApi, $config, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    public function findGame(array $message)
    {
        $game = $this->em->getRepository('AppBundle:Game')->findOneBy(['chatId'=>$message['chat']['id']]);
        if (!$game) {
            // create game
            $game = new Game();
            $game->status = 0;
            $game->chatId = $message['chat']['id'];
            $game->title = isset($message['chat']['title'])
                ? $message['chat']['title']
                : 'No title';

            $this->em->persist($game);
            $this->em->flush();
        }
        return $game;
    }


    public function getCurrentUser(array $message)
    {
        $user = $this->em->getRepository('AppBundle:User')->findOneBy(['tgId'=>$message['from']['id']]);
        if (!$user) {
            $user = new User();
            $user->setName($message['from']['first_name'].' '.$message['from']['last_name']);
            $user->setAlias($message['from']['username']);
            $user->setTgId($message['from']['id']);
            $user->setGame($this->findGame($message));
            $user->setChatId($message['chat']['id']);
            $user->setPoints(0);

            $this->em->persist($user);
            $this->em->flush();
        }
        return $user;
    }

    public function getActiveGames()
    {
        $games = $this->em->getRepository('AppBundle:Game')->findBy(['status'=>1]);
        return $games;
    }
    public function getInactiveGames()
    {
        $games = $this->em->getRepository('AppBundle:Game')->findBy(['status'=>0]);
        return $games;
    }

    public function checkAnswer($message)
    {
        //TODO: Check answer here
    }
}
