<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Gericht", mappedBy="category")
     */
    private $gericht;

    public function __construct()
    {
        $this->gericht = new ArrayCollection();
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

    /**
     * @return Collection<int, Gericht>
     */
    public function getGericht(): Collection
    {
        return $this->gericht;
    }

    public function addGericht(Gericht $gericht): self
    {
        if (!$this->gericht->contains($gericht)) {
            $this->gericht[] = $gericht;
            $gericht->addCategory($this);
        }

        return $this;
    }

    public function removeGericht(Gericht $gericht): self
    {
        if ($this->gericht->removeElement($gericht)) {
            $gericht->removeCategory($this);
        }

        return $this;
    }


    public function __toString(){
        return $this->name;
    }

}
