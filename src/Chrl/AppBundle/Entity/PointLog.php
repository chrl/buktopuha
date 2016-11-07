<?php

namespace Chrl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="points_log")
 */
class PointLog
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
     * @ORM\Column(name="date", type="datetime")
     */
    public $date;

    /**
     * @ORM\Column(type="bigint")
     */
    public $userId;

    /**
     * @ORM\Column(type="bigint")
     */
    public $gameId;

    /**
     * @ORM\Column(type="integer")
     */
    public $day;
    /**
     * @ORM\Column(type="integer")
     */
    public $month;
    /**
     * @ORM\Column(type="integer")
     */
    public $year;

    /**
     * @ORM\Column(type="bigint")
     */
    public $points;
}
