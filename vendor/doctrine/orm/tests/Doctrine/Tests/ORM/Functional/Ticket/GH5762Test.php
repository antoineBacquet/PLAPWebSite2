<?php

namespace Doctrine\Tests\ORM\Functional\Ticket;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Doctrine\Tests\OrmFunctionalTestCase;

/**
 * @group GH-5762
 */
class GH5762Test extends OrmFunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->_schemaTool->createSchema(array(
            $this->_em->getClassMetadata(GH5762Driver::CLASSNAME),
            $this->_em->getClassMetadata(GH5762DriverRide::CLASSNAME),
            $this->_em->getClassMetadata(GH5762Car::CLASSNAME),
        ));
    }

    public function testIssue()
    {
        $result = $this->fetchData();

        self::assertInstanceOf(GH5762Driver::CLASSNAME, $result);
        self::assertInstanceOf('Doctrine\ORM\PersistentCollection', $result->driverRides);
        self::assertInstanceOf(GH5762DriverRide::CLASSNAME, $result->driverRides->get(0));
        self::assertInstanceOf(GH5762Car::CLASSNAME, $result->driverRides->get(0)->car);

        $cars = array();
        foreach ($result->driverRides as $ride) {
            $cars[] = $ride->car->brand;
        }

        self::assertEquals(count($cars), count(array_unique($cars)));

        self::assertContains('BMW', $cars);
        self::assertContains('Crysler', $cars);
        self::assertContains('Dodge', $cars);
        self::assertContains('Mercedes', $cars);
        self::assertContains('Volvo', $cars);
    }

    private function fetchData()
    {
        $this->createData();

        $qb = $this->_em->createQueryBuilder();
        $qb->select('d, dr, c')
            ->from(GH5762Driver::CLASSNAME, 'd')
            ->leftJoin('d.driverRides', 'dr')
            ->leftJoin('dr.car', 'c')
            ->where('d.id = 1');

        return $qb->getQuery()->getSingleResult();
    }

    private function createData()
    {
        $car1 = new GH5762Car('BMW', '7 Series');
        $car2 = new GH5762Car('Crysler', '300');
        $car3 = new GH5762Car('Dodge', 'Dart');
        $car4 = new GH5762Car('Mercedes', 'C-Class');
        $car5 = new GH5762Car('Volvo', 'XC90');

        $driver = new GH5762Driver(1, 'John Doe');

        $ride1 = new GH5762DriverRide($driver, $car1);
        $ride2 = new GH5762DriverRide($driver, $car2);
        $ride3 = new GH5762DriverRide($driver, $car3);
        $ride4 = new GH5762DriverRide($driver, $car4);
        $ride5 = new GH5762DriverRide($driver, $car5);

        $this->_em->persist($car1);
        $this->_em->persist($car2);
        $this->_em->persist($car3);
        $this->_em->persist($car4);
        $this->_em->persist($car5);

        $this->_em->persist($driver);

        $this->_em->persist($ride1);
        $this->_em->persist($ride2);
        $this->_em->persist($ride3);
        $this->_em->persist($ride4);
        $this->_em->persist($ride5);

        $this->_em->flush();
        $this->_em->clear();
    }
}

/**
 * @Entity
 * @Table(name="driver")
 */
class GH5762Driver
{
    const CLASSNAME = __CLASS__;

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="NONE")
     */
    public $id;

    /**
     * @Column(type="string", length=255);
     */
    public $name;

    /**
     * @OneToMany(targetEntity="GH5762DriverRide", mappedBy="driver")
     */
    public $driverRides;

    public function __construct($id, $name)
    {
        $this->driverRides = new ArrayCollection();
        $this->id = $id;
        $this->name = $name;
    }
}

/**
 * @Entity
 * @Table(name="driver_ride")
 */
class GH5762DriverRide
{
    const CLASSNAME = __CLASS__;

    /**
     * @Id
     * @ManyToOne(targetEntity="GH5762Driver", inversedBy="driverRides")
     * @JoinColumn(name="driver_id", referencedColumnName="id")
     */
    public $driver;

    /**
     * @Id
     * @ManyToOne(targetEntity="GH5762Car", inversedBy="carRides")
     * @JoinColumn(name="car", referencedColumnName="brand")
     */
    public $car;

    function __construct(GH5762Driver $driver, GH5762Car $car)
    {
        $this->driver = $driver;
        $this->car = $car;

        $this->driver->driverRides->add($this);
        $this->car->carRides->add($this);
    }
}

/**
 * @Entity
 * @Table(name="car")
 */
class GH5762Car
{
    const CLASSNAME = __CLASS__;

    /**
     * @Id
     * @Column(type="string", length=25)
     * @GeneratedValue(strategy="NONE")
     */
    public $brand;

    /**
     * @Column(type="string", length=255);
     */
    public $model;

    /**
     * @OneToMany(targetEntity="GH5762DriverRide", mappedBy="car")
     */
    public $carRides;

    public function __construct($brand, $model)
    {
        $this->carRides = new ArrayCollection();
        $this->brand = $brand;
        $this->model = $model;
    }
}
