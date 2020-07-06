<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Celebrity
 *
 * @ORM\Entity(repositoryClass="App\Repository\CelebrityRepository")
 */
class Celebrity
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
    private $nickName;

    /**
     * @var string
     *
     * @ORM\Column(length=50, type="string")
     */
    private $lastFirstName;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $profession;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $nationality;

    /**
     * @var Cemetery
     *
     * @ORM\ManyToOne(targetEntity="Cemetery")
     */
    private $cemetery;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $deathDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickName(): ?string
    {
        return $this->nickName;
    }

    public function setNickName(string $nickName): self
    {
        $this->nickName = $nickName;

        return $this;
    }

    public function getLastFirstName(): ?string
    {
        return $this->lastFirstName;
    }

    public function setLastFirstName(string $lastFirstName): self
    {
        $this->lastFirstName = $lastFirstName;

        return $this;
    }

    public function getProfession(): ?array
    {
        return $this->profession;
    }

    public function setProfession(array $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getNationality(): ?array
    {
        return $this->nationality;
    }

    public function setNationality(array $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate;
    }

    public function setDeathDate(\DateTimeInterface $deathDate): self
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    public function getCemetery(): ?Cemetery
    {
        return $this->cemetery;
    }

    public function setCemetery(?Cemetery $cemetery): self
    {
        $this->cemetery = $cemetery;

        return $this;
    }
}