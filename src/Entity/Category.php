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
     * @ORM\ManyToMany(targetEntity=Sock::class, mappedBy="category")
     */
    private $socks;

    /**
     * @ORM\Column(type="string", length=2083, nullable=true)
     */
    private $picture;

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
            $sock->addCategory($this);
        }

        return $this;
    }

    public function removeSock(Sock $sock): self
    {
        if ($this->socks->removeElement($sock)) {
            $sock->removeCategory($this);
        }

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
