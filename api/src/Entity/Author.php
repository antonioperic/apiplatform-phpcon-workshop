<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 *
 * @ORM\Entity
 */
class Author
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
    public $lastname = '';

    /**
     * @ORM\Column(type="date")
     */
    public $birthdate = '';

    public function getId(): int
    {
        return $this->id;
    }
}
