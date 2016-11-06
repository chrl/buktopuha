<?php

namespace Chrl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class Message
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
     * @ORM\ManyToOne(targetEntity="Chrl\AppBundle\Entity\User", inversedBy="messages")
     */
    public $user;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    public $date;

    /**
     * @ORM\ManyToOne(targetEntity="Chrl\AppBundle\Entity\Game", inversedBy="messages")
     */
    public $game;
    /**
     * @ORM\Column(name="text", type="text")
     */
    public $text;
}
