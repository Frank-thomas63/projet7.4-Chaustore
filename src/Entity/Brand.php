<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandRepository")
 * @UniqueEntity("name") //  allows to have only one brand
 */
class Brand
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
     * @ORM\OneToMany(targetEntity="Product", mappedBy="brand")
     */
    private $brand_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;


    public function __construct()
    {
        $this->brand_id = new ArrayCollection();
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
     * @return Collection|product[]
     */
    public function getBrandId(): Collection
    {
        return $this->brand_id;
    }

    public function addBrandId(product $brandId): self
    {
        if (!$this->brand_id->contains($brandId)) {
            $this->brand_id[] = $brandId;
            $brandId->setBrand($this);
        }

        return $this;
    }

    public function removeBrandId(product $brandId): self
    {
        if ($this->brand_id->contains($brandId)) {
            $this->brand_id->removeElement($brandId);
            // set the owning side to null (unless already changed)
            if ($brandId->getBrand() === $this) {
                $brandId->setBrand(null);
            }
        }

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }
    /**
     * @return null|string
     */

    public function getFilename(): ?string
    {
        return $this->Filename;
    }

     /**
     * @return Brand
     */

    public function setFilename(?string $Filename): self
    {
        $this->Filename = $Filename;

        return $this;
    }


}
