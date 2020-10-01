<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity
 * @ORM\Table(name="`objects`")
 */


class Objects{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $image;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @ORM\ManyToOne(targetEntity="App\Entities\Category", inversedBy="objects")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $category;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $description;

    public function __construct($input)
    {
        $this->setTitle($input['title']);
        $this->setImage($input['image']);
        $this->setCategory($input['category']);
        $this->setDescription($input['description']);
    }



    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}