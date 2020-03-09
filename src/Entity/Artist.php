<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
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
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Performance", mappedBy="artist")
     */
    private $performances;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
    }

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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection|Performance[]
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performances->contains($performance)) {
            $this->performances[] = $performance;
            $performance->setArtist($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->contains($performance)) {
            $this->performances->removeElement($performance);
            // set the owning side to null (unless already changed)
            if ($performance->getArtist() === $this) {
                $performance->setArtist(null);
            }
        }

        return $this;
    }
}
