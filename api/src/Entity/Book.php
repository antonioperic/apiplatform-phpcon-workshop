<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a book entity.
 *
 * @ORM\Entity
 */
class Book
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    public $isbn = '';
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    public $title = '';
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $abstract = '';
    /**
     * @var \DateTime A nice person
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    public $publicationDate = '';
    /**
     * @var string A nice person
     *
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    public $avarageReviewRate = '';
    /**
     * @var int A nice person
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Author", mappedBy="author")

     * @ORM\Column(type="int")
     * @Assert\NotBlank
     */
    public $author_id = '';
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAbstract(): string
    {
        return $this->abstract;
    }

    /**
     * @param string $abstract
     */
    public function setAbstract(string $abstract): void
    {
        $this->abstract = $abstract;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationDate(): \DateTime
    {
        return $this->publicationDate;
    }

    /**
     * @param \DateTime $publicationDate
     */
    public function setPublicationDate(\DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return string
     */
    public function getAvarageReviewRate(): string
    {
        return $this->avarageReviewRate;
    }

    /**
     * @param string $avarageReviewRate
     */
    public function setAvarageReviewRate(string $avarageReviewRate): void
    {
        $this->avarageReviewRate = $avarageReviewRate;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    /**
     * @param int $author_id
     */
    public function setAuthorId(int $author_id): void
    {
        $this->author_id = $author_id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
