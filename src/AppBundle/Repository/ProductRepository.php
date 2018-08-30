<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/30/2018
 * Time: 1:34 PM
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var
     */
    private $repository;

    /**
     * ProductRepository constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Product::class);
        $this->em = $em;
    }

    public function findOneById($productId): ?Product
    {
        return $this->repository->find($productId);
    }

    public function save(Product $product)
    {
        $this->em->persist($product);
        $this->em->flush();
    }

    public function delete(Product $product)
    {
        $this->em->remove($product);
        $this->em->flush();
    }
}