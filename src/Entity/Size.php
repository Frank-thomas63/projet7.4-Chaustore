<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SizeRepository")
 * @UniqueEntity("name") //  allows to have only one size
 */
class Size
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="size")
     */
    private $size_id;

    public function __construct()
    {
        $this->size_id = new ArrayCollection();
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
     * @return Collection|stock[]
     */
    public function getstocks(): Collection
    {
        return $this->size_id;
    }

    public function addstocks(stock $stocks): self
    {
        if (!$this->size_id->contains($stocks)) {
            $this->size_id[] = $stocks;
            $stocks->setSize($this);
        }

        return $this;
    }

    public function removestocks(stock $stocks): self
    {
        if ($this->size_id->contains($stocks)) {
            $this->size_id->removeElement($stocks);
            // set the owning side to null (unless already changed)
            if ($stocks->getSize() === $this) {
                $stocks->setSize(null);
            }
        }

        return $this;
    }
}
