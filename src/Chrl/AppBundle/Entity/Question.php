<?php

namespace Chrl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Question
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="questions")
 */
class Question
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
     * GUID Of the question -- unique
     *
     * @ORM\Column(type="string",length=32,unique=true)
     */
    public $guid;
    /**
     * @ORM\Column(type="text")
     */
    public $text;
    /**
     * @ORM\Column(type="text")
     */
    public $a1;
    /**
     * @ORM\Column(type="text")
     */
    public $a2;
    /**
     * @ORM\Column(type="text")
     */
    public $a3;
    /**
     * @ORM\Column(type="text")
     */
    public $a4;
    /**
     * @ORM\Column(type="integer")
     */
    public $price;
    /**
     * @ORM\Column(type="integer")
     */
    public $played;
    /**
     * @ORM\Column(type="integer")
     */
    public $correct;
    /**
     * @ORM\Column(type="string", length=30)
     */
    public $category;
}
