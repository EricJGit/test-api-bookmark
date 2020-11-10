<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Lien
 * @package App\Entity
 * @ORM\MappedSuperclass()
 */
abstract class Lien
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $url;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $titre;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $auteur;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private DateTime $date;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Lien
     */
    public function setUrl(string $url): Lien
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Lien
     */
    public function setType(string $type): Lien
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return Lien
     */
    public function setTitre(string $titre): Lien
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     * @return Lien
     */
    public function setAuteur(string $auteur): Lien
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Lien
     */
    public function setDate(DateTime $date): Lien
    {
        $this->date = $date;

        return $this;
    }
}
