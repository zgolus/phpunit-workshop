<?php


namespace App\Test\Util;


use App\Entity\Number;
use App\Repository\NumberRepository;
use App\Util\Foo;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class FooTest extends TestCase
{
    /** @var LoggerInterface|MockObject */
    private $logger;
    /** @var Foo */
    private $sut;
    /** @var EntityManagerInterface|MockObject */
    private $em;
    /** @var NumberRepository|MockObject */
    private $repository;

    public function setUp()
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->em = $this->createMock(EntityManagerInterface::class);
        $this->repository = $this->createMock(NumberRepository::class);

        $this->sut = new Foo($this->em, $this->logger);
    }

    /**
     * @dataProvider addProvider
     * @param $x
     * @param $y
     * @param $expected
     */
    public function testAdd($x, $y, $expected)
    {
        $number = new Number();
        $number->setA($x);
        $number->setB($y);
        $this->repository->expects($this->once())->method('find')->with(1)->willReturn($number);
        $this->em->expects($this->once())->method('getRepository')->willReturn($this->repository);

        $this->logger->expects($this->once())->method('info');

        $this->assertEquals($expected, $this->sut->add(1));
    }

    /**
     * @dataProvider divideProvider
     * @param $x
     * @param $y
     * @param $expected
     */
    public function testDivide($x, $y, $expected)
    {
        $number = new Number();
        $number->setA($x);
        $number->setB($y);
        $this->repository->expects($this->once())->method('find')->with(1)->willReturn($number);
        $this->em->expects($this->once())->method('getRepository')->willReturn($this->repository);

        $this->assertEquals($expected, $this->sut->divide(1));
    }

    public function testDivideByZero()
    {
        $this->expectException(\Exception::class);
        $number = new Number();
        $number->setA(1);
        $number->setB(0);
        $this->repository->expects($this->once())->method('find')->with(1)->willReturn($number);
        $this->em->expects($this->once())->method('getRepository')->willReturn($this->repository);

        $this->sut->divide(1);
    }

    public function addProvider()
    {
        return [
            'first'  => [2, 3, 5],
            'second' => [2, 4, 6],
        ];
    }

    public function divideProvider()
    {
        return [
            'first'  => [8, 2, 4],
            'second' => [6, 3, 2],
        ];
    }
}