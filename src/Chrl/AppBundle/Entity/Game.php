<?php

namespace Chrl\AppBundle\Entity;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="chat_id", type="bigint", nullable=false)
     */
    public $chatId;

    /**
     * @ORM\OneToMany(targetEntity="Chrl\AppBundle\Entity\User", mappedBy="game")
     */
    public $users;
    /**
     * @ORM\Column(name="status", type="smallint")
     */
    public $status;

    /**
     * @ORM\Column(name="title", type="string")
     */
    public $title;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $publicLink;
    /**
     * @ORM\OneToMany(targetEntity="Chrl\AppBundle\Entity\Message", mappedBy="game")
     */
    public $messages;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    public $lastQuestion;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $lastQuestionTime;
}
