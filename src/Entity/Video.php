<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * Class Video
 * @package App\Entity
 * @ORM\Entity
 */
class Video extends Lien
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
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $duree;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return Video
     */
    public function setId(UuidInterface $id): Video
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
     * @return Video
     */
    public function setLargeur(int $largeur): Video
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
     * @return Video
     */
    public function setHauteur(int $hauteur): Video
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuree(): int
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     * @return Video
     */
    public function setDuree(int $duree): Video
    {
        $this->duree = $duree;

        return $this;
    }
}
