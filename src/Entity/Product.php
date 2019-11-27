<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @UniqueEntity("name") //  allows to have only one product
 */
class Product
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
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="product")
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="category_id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="brand_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Color", inversedBy="color_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $color;

   /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;   


    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    public function __construct()
    {
        $this->product_id = new ArrayCollection();
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
        return $this->product_id;
    }

    public function addstocks(stock $stocks): self
    {
        if (!$this->product_id->contains($stocks)) {
            $this->product_id[] = $stocks;
            $stocks->setProduct($this);
        }

        return $this;
    }

    public function removestocks(stock $stocks): self
    {
        if ($this->product_id->contains($stocks)) {
            $this->product_id->removeElement($stocks);
            // set the owning side to null (unless already changed)
            if ($stocks->getProduct() === $this) {
                $stocks->setProduct(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }


    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }
}
