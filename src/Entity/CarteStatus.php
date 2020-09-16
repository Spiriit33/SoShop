<?php

namespace App\Entity;

use App\Repository\CarteStatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarteStatusRepository::class)
 */
class CarteStatus
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
     * @ORM\OneToOne(targetEntity=Carte::class, mappedBy="status")
     */
    private $carte;

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

    public function getCarte(): ?Carte
    {
        return $this->carte;
    }

    public function setCarte(Carte $carte): self
    {
        $this->carte = $carte;

        // set the owning side of the relation if necessary
        if ($carte->getStatus() !== $this) {
            $carte->setStatus($this);
        }

        return $this;
    }
}
