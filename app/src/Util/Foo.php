<?php

namespace App\Util;


use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class Foo
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->em = $em;
    }

    public function add($id)
    {
        $repository = $this->em->getRepository(Number::class);
        /** @var Number $row */
        $row = $repository->find($id);

        $this->logger->info("I am an operator with my pocket calculator");

        return $row->getA() + $row->getB();
    }

    public function divide($id)
    {
        $repository = $this->em->getRepository(Number::class);
        /** @var Number $row */
        $row = $repository->find($id);

        if ($row->getB() == 0) {
            throw new \Exception('Boom!');
        }

        return $row->getA() / $row->getB();
    }
}