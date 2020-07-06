<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class City
 *
 * @ORM\Entity()
 */
class City
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
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(length=10, type="string")
     */
    private $zipCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
}