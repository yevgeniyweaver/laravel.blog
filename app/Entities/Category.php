<?php

namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: riset
 * Date: 29.09.2020
 * Time: 22:51
 */
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */

class Category{

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
    protected $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entities\Objects", mappedBy="category")
     */
    private $objects;

    public function __construct($input)
    {
        $this->setTitle($input['title']);
        $this->setDescription($input['description']);
        $this->setDescription($input['description']);
        $this->objects = new ArrayCollection();
    }

    /**
     * @return Collection|Objects[]
     */
    public function getObjects(): Collection
    {
        return $this->objects;
    }

//    private $products;
//
//    public function __construct()
//    {
//        $this->products = new ArrayCollection();
//    }
//    /**
//     * @return Collection|Product[]
//     */
//    public function getProducts(): Collection
//    {
//        return $this->products;
//    }

    // addProduct() and removeProduct() were also added


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


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}