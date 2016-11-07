<?php

namespace Chrl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
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
     * @return User
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
     * @ORM\Column(name="telegram_id", type="bigint")
     */
    protected $tgId;

    /**
     * @return mixed
     */
    public function getTgId()
    {
        return $this->tgId;
    }

    /**
     * @param mixed $tgId
     */
    public function setTgId($tgId)
    {
        $this->tgId = $tgId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return str_replace('_', '\_', $this->alias);
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param Game $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", nullable=true)
     */
    protected $alias;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="bigint")
     */
    protected $points;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Chrl\AppBundle\Entity\Game", inversedBy="users")
     */
    public $game;
    /**
     * @ORM\OneToMany(targetEntity="Chrl\AppBundle\Entity\Message", mappedBy="user")
     */
    public $messages;
}
