<?php
/**
 * Created by PhpStorm.
 * User: riset
 * Date: 29.09.2020
 * Time: 23:51
 */
namespace App\Repository;
use App\Entities\Objects;
use Doctrine\ORM\EntityManager;

class ObjectsRepo
{

    /**
     * @var string
     */
    private $class = 'App\Entity\Objects';
    /**
     * @var EntityManager
     */
    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function create(Objects $objects)
    {
        $this->em->persist($objects);
        $this->em->flush();
    }

    public function update(Objects $objects, $data)
    {
        $objects->setTitle($data['title']);
        $objects->setImage($data['body']);
        $objects->setCategory($data['title']);
        $objects->setDescription($data['body']);
        $this->em->persist($objects);
        $this->em->flush();
    }

    public function PostOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

    public function delete(Objects $objects)
    {
        $this->em->remove($objects);
        $this->em->flush();
    }

    /**
     * create Post
     * @return Objects
     */
    private function prepareData($data)
    {
        return new Objects($data);
    }
}