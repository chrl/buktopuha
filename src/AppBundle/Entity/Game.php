<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Game
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="chat_id", type="bigint", nullable=false)
     */
    protected $chatId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="gameId")
     */
    public $users;
}
