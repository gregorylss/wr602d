<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $media = null;

    #[ORM\Column(length: 255)]
    private ?int $pdfLimit = null;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'subscription')]
    private Collection $subs;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'subscription')]
    private Collection $users;

    public function __construct()
    {
        $this->subs = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }


    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getPdfLimit(): ?int
    {
        return $this->pdfLimit;
    }

    public function setPdfLimit(?int $pdfLimit): void
    {
        $this->pdfLimit = $pdfLimit;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSubs(): Collection
    {
        return $this->subs;
    }

    public function addSub(User $sub): static
    {
        if (!$this->subs->contains($sub)) {
            $this->subs->add($sub);
            $sub->setSubscription($this);
        }

        return $this;
    }

    public function removeSub(User $sub): static
    {
        if ($this->subs->removeElement($sub)) {
            // set the owning side to null (unless already changed)
            if ($sub->getSubscription() === $this) {
                $sub->setSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setSubscription($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSubscription() === $this) {
                $user->setSubscription(null);
            }
        }

        return $this;
    }


}
