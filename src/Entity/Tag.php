<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Tag
 * @package App\Entity
 * @ORM\Entity
 */
class Tag
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
     * @var string
     * @ORM\Column(type="string")
     */
    private string $label;

    /**
     * @var Bookmark
     * @ORM\ManyToOne(targetEntity=Bookmark::class, inversedBy="tags")
     */
    private Bookmark $bookmark;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return Tag
     */
    public function setId(UuidInterface $id): Tag
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Tag
     */
    public function setLabel(string $label): Tag
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Bookmark
     */
    public function getBookmark(): Bookmark
    {
        return $this->bookmark;
    }

    /**
     * @param Bookmark $bookmark
     * @return Tag
     */
    public function setBookmark(Bookmark $bookmark): Tag
    {
        $this->bookmark = $bookmark;

        return $this;
    }
}
