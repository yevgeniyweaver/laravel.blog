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
    private $class = 'App\Entities\Objects';
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
        var_dump('OK');
    }

    public function update(Objects $objects, $data)
    {
        $objects->setTitle($data['title']);
        $objects->setImage($data['image']);
        $objects->setCategory($data['category']);
        $objects->setDescription($data['description']);
        $this->em->persist($objects);
        $this->em->flush();
    }

    public function PostOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

    public function show($id){
//        $object = $this->getDoctrine()
//            ->getRepository(Objects::class)
//            ->find($id);
//        $categoryName = $object->getCategory()->getName();
        $object = $this->em->getRepository(Objects::class)->find($id);
        return $object;
    }

    public function showAll()
    {
        //$productRepository = $entityManager->getRepository('Product');
        //$products = $productRepository->findAll();
        $objects = $this->em->getRepository(Objects::class)->findAll();
        return $objects;
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
    public function prepareData($data)
    {
        return new Objects($data);
    }
}