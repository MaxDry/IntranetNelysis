<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembersRepository")
 */
class Members
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="text")
     */
    private $ambitions;

    /**
     * @ORM\Column(type="text")
     */
    private $oldTeams;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainGame;

    /**
     * @ORM\Column(type="text")
     */
    private $whyUs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ranks")
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LineUp")
     */
    private $lineUp;

 

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

    public function getAge(): ?float
    {
        return $this->age;
    }

    public function setAge(float $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAmbitions(): ?string
    {
        return $this->ambitions;
    }

    public function setAmbitions(string $ambitions): self
    {
        $this->ambitions = $ambitions;

        return $this;
    }

    public function getOldTeams(): ?string
    {
        return $this->oldTeams;
    }

    public function setOldTeams(string $oldTeams): self
    {
        $this->oldTeams = $oldTeams;

        return $this;
    }

    public function getMainGame(): ?string
    {
        return $this->mainGame;
    }

    public function setMainGame(string $mainGame): self
    {
        $this->mainGame = $mainGame;

        return $this;
    }

    public function getWhyUs(): ?string
    {
        return $this->whyUs;
    }

    public function setWhyUs(string $whyUs): self
    {
        $this->whyUs = $whyUs;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getRank(): ?Ranks
    {
        return $this->rank;
    }

    public function setRank(?Ranks $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getLineUp(): ?LineUp
    {
        return $this->lineUp;
    }

    public function setLineUp(?LineUp $lineUp): self
    {
        $this->lineUp = $lineUp;

        return $this;
    }

}
