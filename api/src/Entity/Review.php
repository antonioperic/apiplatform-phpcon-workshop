<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 *
 * @ORM\Entity
 */
class Review
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
     * @ORM\Column(type="string", length=255)
     */
    public $firstname = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $author = '';

    /**
     * @ORM\Column(type="text")
     */
    public $review = '';

    /**
     * @var
     * @ORM\Column(type="integer")
     */
    private $book_id;

    /**
     * @ORM\Column(type="date")
     */
    public $created_at = '';

    public function getId(): int
    {
        return $this->id;
    }
}
