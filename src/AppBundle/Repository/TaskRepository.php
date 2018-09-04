<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/3/2018
 * Time: 4:19 PM
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskRepository
{
    private $em;

    private $repository;

    /**
     * TaskRepository constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Task::class);
    }

    public function save(Task $task)
    {
        $this->em->persist($task);
        $this->em->flush();
    }

    public function findOneById($id) : ?Task
    {
        return $this->repository->find($id);
    }
}