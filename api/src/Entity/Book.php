<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"book_read", "book_extra", "book_extra", "book_write"})
     *
     * @ORM\Column(type="string", length=13)
     * @Assert\NotBlank
     * @Assert\Isbn(
     *     type = "isbn13",
     *     message = "This value is not  valid."
     * )
     */
    private $isbn;

    /**
     * @Groups({"book_read", "book_extra", "book_write"})
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @Groups({"book_extra", "book_write"})
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $abstract;

    /**
     * @Groups({"book_extra", "book_write"})
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $publicationDate;

    /**
     * @Groups({"book_extra"})
     * @ORM\Column(type="float")
     */
    private $averageReviewRate;

    /**
     *
     * @Groups({ "book_extra", "book_write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author;

    /**
     * @Groups({ "book_extra", "book_write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="book")
     */
    private $reviews;

    /**
     * @Groups({"book_extra", "book_write"})
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getAverageReviewRate(): ?float
    {
        return $this->averageReviewRate;
    }

    public function setAverageReviewRate(float $averageReviewRate): self
    {
        $this->averageReviewRate = $averageReviewRate;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setBook($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getBook() === $this) {
                $review->setBook(null);
            }
        }

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
}
