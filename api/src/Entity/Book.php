<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 *
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int ISBN of the book
     *
     * @ORM\Column(type="integer")
     */
    private $isbn;

    /**
     * @var string Title of the book
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $abstract;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     */
    private $publicationDate;

    /**
     * @var float
     *
     * @ORM\Column
     * @ORM\Column(type="float")
     */
    private $averageReviewRate;

    /**
     * @var
     * @ORM\Column(type="integer")
     */
    private $author_id;

    public function getId(): int
    {
        return $this->id;
    }
}
