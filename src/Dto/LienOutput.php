<?php

namespace App\Dto;

class LienOutput implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $titre;

    /**
     * @var string
     */
    private string $auteur;

    /**
     * @var string
     */
    private string $date;

    /**
     * @var int
     */
    private int $largeur;

    /**
     * @var int
     */
    private int $hauteur;

    /**
     * @var int
     */
    private int $duree;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return LienOutput
     */
    public function setUrl(string $url): LienOutput
    {
        $this->url = $url;

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
     * @return LienOutput
     */
    public function setTitre(string $titre): LienOutput
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
     * @return LienOutput
     */
    public function setAuteur(string $auteur): LienOutput
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return LienOutput
     */
    public function setDate(string $date): LienOutput
    {
        $this->date = $date;

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
     * @return LienOutput
     */
    public function setLargeur(int $largeur): LienOutput
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
     * @return LienOutput
     */
    public function setHauteur(int $hauteur): LienOutput
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
     * @return LienOutput
     */
    public function setDuree(int $duree): LienOutput
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
