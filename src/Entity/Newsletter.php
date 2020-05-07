<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsletterRepository")
 * @UniqueEntity(
 *     "email",
 *     message="Already registered to our newsletter !"
 * )
 */
class Newsletter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Please enter an email address !")
     * @Assert\Email(message="Invalid email address !")
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $logged;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogged(): ?\DateTimeInterface
    {
        return $this->logged;
    }

    public function setLogged(\DateTimeInterface $logged): self
    {
        $this->logged = $logged;

        return $this;
    }
}
