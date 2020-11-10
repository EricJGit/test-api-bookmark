<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * Class Image
 * @package App\Entity
 * @ORM\Entity
 */
class Image extends Lien
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private UuidInterface $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $largeur;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $hauteur;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return Image
     */
    public function setId(UuidInterface $id): Image
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getLargeur(): int
    {
        return $this->largeur;
    }

    /**
     * @param int $largeur
     * @return Image
     */
    public function setLargeur(int $largeur): Image
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * @return int
     */
    public function getHauteur(): int
    {
        return $this->hauteur;
    }

    /**
     * @param int $hauteur
     * @return Image
     */
    public function setHauteur(int $hauteur): Image
    {
        $this->hauteur = $hauteur;

        return $this;
    }

}
