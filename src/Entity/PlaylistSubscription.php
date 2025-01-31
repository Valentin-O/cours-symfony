<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $subscriptionId = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $playlistId = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $suscribedAt = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    private ?User $customer = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'playlistSubscriptions')]
    private ?self $playlist = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    private ?Playlist $suscription = null;

    
    
    

    public function __construct()
    {
        $this->playlistSubscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscriptionId(): ?int
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionId(int $subscriptionId): static
    {
        $this->subscriptionId = $subscriptionId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPlaylistId(): ?int
    {
        return $this->playlistId;
    }

    public function setPlaylistId(int $playlistId): static
    {
        $this->playlistId = $playlistId;

        return $this;
    }

    public function getSuscribedAt(): ?\DateTimeImmutable
    {
        return $this->suscribedAt;
    }

    public function setSuscribedAt(\DateTimeImmutable $suscribedAt): static
    {
        $this->suscribedAt = $suscribedAt;

        return $this;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getPlaylist(): ?self
    {
        return $this->playlist;
    }

    public function setPlaylist(?self $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPlaylistSubscriptions(): Collection
    {
        return $this->playlistSubscriptions;
    }

    public function addPlaylistSubscription(self $playlistSubscription): static
    {
        if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
            $this->playlistSubscriptions->add($playlistSubscription);
            $playlistSubscription->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(self $playlistSubscription): static
    {
        if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getPlaylist() === $this) {
                $playlistSubscription->setPlaylist(null);
            }
        }

        return $this;
    }

    public function getSuscription(): ?Playlist
    {
        return $this->suscription;
    }

    public function setSuscription(?Playlist $suscription): static
    {
        $this->suscription = $suscription;

        return $this;
    }
}
