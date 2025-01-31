<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\UserAccountStatusEnum;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    

    #[ORM\Column(enumType: UserAccountStatusEnum::class)]
    private ?UserAccountStatusEnum $accountStatus = null;



    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'client')]
    private Collection $comments;

    /**
     * @var Collection<int, Suscription>
     */
    #[ORM\OneToMany(targetEntity: Suscription::class, mappedBy: 'customer')]
    private Collection $current_subscription;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'customer')]
    private Collection $subscriptionHistories;

    /**
     * @var Collection<int, PlaylistSubscription>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'customer')]
    private Collection $playlistSubscriptions;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'customer')]
    private Collection $playlists;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->current_subscription = new ArrayCollection();
        $this->subscriptionHistories = new ArrayCollection();
        $this->playlistSubscriptions = new ArrayCollection();
        $this->playlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    

    public function getAccountStatus(): ?string
    {
        return $this->accountStatus;
    }

    public function setAccountStatus(string $accountStatus): static
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    

    /**
     * @return Collection<int, Comment>
     */
    public function getcomments(): Collection
    {
        return $this->comments;
    }

    public function addMedium(Comment $medium): static
    {
        if (!$this->comments->contains($medium)) {
            $this->comments->add($medium);
            $medium->setClient($this);
        }

        return $this;
    }

    public function removeMedium(Comment $medium): static
    {
        if ($this->comments->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getClient() === $this) {
                $medium->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Suscription>
     */
    public function getCurrentSubscription(): Collection
    {
        return $this->current_subscription;
    }

    public function addCurrentSubscription(Suscription $currentSubscription): static
    {
        if (!$this->current_subscription->contains($currentSubscription)) {
            $this->current_subscription->add($currentSubscription);
            $currentSubscription->setCustomer($this);
        }

        return $this;
    }

    public function removeCurrentSubscription(Suscription $currentSubscription): static
    {
        if ($this->current_subscription->removeElement($currentSubscription)) {
            // set the owning side to null (unless already changed)
            if ($currentSubscription->getCustomer() === $this) {
                $currentSubscription->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getSubscriptionHistories(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
            $this->subscriptionHistories->add($subscriptionHistory);
            $subscriptionHistory->setCustomer($this);
        }

        return $this;
    }

    public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionHistory->getCustomer() === $this) {
                $subscriptionHistory->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscription>
     */
    public function getPlaylistSubscriptions(): Collection
    {
        return $this->playlistSubscriptions;
    }

    public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
            $this->playlistSubscriptions->add($playlistSubscription);
            $playlistSubscription->setCustomer($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getCustomer() === $this) {
                $playlistSubscription->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setCustomer($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getCustomer() === $this) {
                $playlist->setCustomer(null);
            }
        }

        return $this;
    }
}
