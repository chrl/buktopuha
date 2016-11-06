<?php

namespace Chrl\AppBundle\Service;

use Chrl\AppBundle\Entity\Question;
use Doctrine\ORM\EntityManager;
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
    /** @var EntityManager */
    public $em;
    /** @var BuktopuhaBotApi */
    private $botApi;

    public function __construct(BuktopuhaBotApi $telegramBotApi, $config, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->botApi = $telegramBotApi;
    }


    /**
     * @return Game
     */
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
            $user->setName(
                (
                    isset($message['from']['first_name'])
                    ? $message['from']['first_name']
                    : ''
                )
                .' '.
                (
                isset($message['from']['last_name'])
                    ? $message['from']['last_name']
                    : ''
                )
            );
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
        $game = $this->findGame($message);
        $user = $this->getCurrentUser($message);

        if ($game->status == 1) {
            /** @var Question $question */
            $question = $this->em->getRepository('AppBundle:Question')->find($game->lastQuestion);

            if (!$question) {
                return;
            }

            if (mb_strtoupper($question->a1, 'UTF-8') == mb_strtoupper($message['text'], 'UTF-8')) {
                // Correct answer!

                $user->setPoints($user->getPoints()+$question->price);
                $this->em->persist($user);

                $this->botApi->sendMessage(
                    $game->chatId,
                    'Correct! @'.$user->getAlias().' gets *'.
                    $question->price.'* and now has *'.$user->getPoints().'* points!',
                    'markdown',
                    false,
                    $message['message_id']
                );

                $question->correct++;
                $this->em->persist($question);

                $question = $this->getRandomQuestion();

                $game->lastQuestion = $question->getId();
                $game->lastQuestionTime = new \DateTime('now');
                $game->incorrectTries = 0;
                
                $this->askQuestion($game, $question);
            } else {
                // Incorrect answer
                $game->incorrectTries++;
                $this->botApi->sendMessage(
                    $game->chatId,
                    'Wrong, @'.$user->getAlias().'. Correct answer: *'.$question->a1.'*',
                    'markdown'
                );
            }

            $this->em->persist($game);
            $this->em->flush();
        }
    }

    public function askQuestion(Game $game, Question $question)
    {
        $this->botApi->sendMessage($game->chatId, '*[question]* '.$question->text.' _('.mb_strlen($question->a1,'UTF-8').'letters)_', 'markdown');
    }

    /**
     * @return Question
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getRandomQuestion()
    {
        $count = $this->em->createQueryBuilder()
            ->select('COUNT(u)')->from('AppBundle:Question', 'u')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->em->createQuery('SELECT c FROM AppBundle:Question c ORDER BY c.id ASC')
            ->setFirstResult(rand(0, $count - 1))
            ->setMaxResults(1)
            ->getSingleResult();
    }
}
