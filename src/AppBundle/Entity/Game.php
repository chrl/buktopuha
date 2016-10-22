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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Game
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * @param int $chatId
     * @return User
     */
    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        return $this;
    }
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
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    protected $name;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="gameId")
     */
    public $users;
    
}
