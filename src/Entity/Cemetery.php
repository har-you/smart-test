<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Cemetery
 *
 * @ORM\Entity()
 */
class Cemetery
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(length=50, type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(length=50, type="string")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(length=50, type="string")
     */
    private $gpsCoordinates;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\City")
     */
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGpsCoordinates(): ?string
    {
        return $this->gpsCoordinates;
    }

    public function setGpsCoordinates(string $gpsCoordinates): self
    {
        $this->gpsCoordinates = $gpsCoordinates;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}