<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
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
     * @ORM\OneToMany(targetEntity=Sock::class, mappedBy="brand")
     */
    private $socks;

    public function __construct()
    {
        $this->socks = new ArrayCollection();
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
     * @return Collection<int, Sock>
     */
    public function getSocks(): Collection
    {
        return $this->socks;
    }

    public function addSock(Sock $sock): self
    {
        if (!$this->socks->contains($sock)) {
            $this->socks[] = $sock;
            $sock->setBrand($this);
        }

        return $this;
    }

    public function removeSock(Sock $sock): self
    {
        if ($this->socks->removeElement($sock)) {
            // set the owning side to null (unless already changed)
            if ($sock->getBrand() === $this) {
                $sock->setBrand(null);
            }
        }

        return $this;
    }
}
