<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
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
    private $especie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $altura;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Habitat", mappedBy="animals")
     */
    private $habitats;

    public function __construct()
    {
        $this->habitats = new ArrayCollection();
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

    public function getEspecie(): ?string
    {
        return $this->especie;
    }

    public function setEspecie(string $especie): self
    {
        $this->especie = $especie;

        return $this;
    }

    public function getPes(): ?int
    {
        return $this->pes;
    }

    public function setPes(?int $pes): self
    {
        $this->pes = $pes;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(?int $altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * @return Collection|Habitat[]
     */
    public function getHabitats(): Collection
    {
        return $this->habitats;
    }

    public function addHabitat(Habitat $habitat): self
    {
        if (!$this->habitats->contains($habitat)) {
            $this->habitats[] = $habitat;
            $habitat->addAnimal($this);
        }

        return $this;
    }

    public function removeHabitat(Habitat $habitat): self
    {
        if ($this->habitats->contains($habitat)) {
            $this->habitats->removeElement($habitat);
            $habitat->removeAnimal($this);
        }

        return $this;
    }

    public function removeAllHabitats(): self
    {
        foreach ($this->getHabitats() as $habitat) {
            $this->removeHabitat($habitat);
        }

        return $this;
    }
}
