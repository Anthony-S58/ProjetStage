<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Postimg::class, mappedBy="post", orphanRemoval="true")
     */
    private $postimg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategories(): ?categories
    {
        return $this->categories;
    }

    public function setCategories(?categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function __construct()
    {
    $this->date = new \DateTime('now');
    $this->postimg = new ArrayCollection();
    }

    /**
     * @return Collection|Postimg[]
     */
    public function getPostimg(): Collection
    {
        return $this->postimg;
    }

    public function addPostimg(Postimg $postimg): self
    {
        if (!$this->postimg->contains($postimg)) {
            $this->postimg[] = $postimg;
            $postimg->setPost($this);
        }

        return $this;
    }

    public function removePostimg(Postimg $postimg): self
    {
        if ($this->postimg->removeElement($postimg)) {
            // set the owning side to null (unless already changed)
            if ($postimg->getPost() === $this) {
                $postimg->setPost(null);
            }
        }

        return $this;
    }

}
