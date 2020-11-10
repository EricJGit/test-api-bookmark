<?php

namespace App\Entity;

use App\Repository\BookmarkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Bookmark
 * @package App\Entity
 * @ORM\Entity(repositoryClass=BookmarkRepository::class)
 */
class Bookmark
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
     * @var Collection|Tag[]
     * @ORM\OneToMany(targetEntity=Tag::class, cascade={"persist", "remove"}, mappedBy="bookmark")
     */
    private Collection $tags;

    /**
     * @var Image
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    private Image $image;

    /**
     * @var Video
     * @ORM\OneToOne(targetEntity=Video::class, cascade={"persist", "remove"})
     */
    private Video $video;

    /**
     * Bookmark constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return Bookmark
     */
    public function setId(UuidInterface $id): Bookmark
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Collection $tags
     * @return Bookmark
     */
    public function setTags(Collection $tags): Bookmark
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function deleteTag(Tag $tag)
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     * @return Bookmark
     */
    public function setImage(Image $image): Bookmark
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo(): Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return Bookmark
     */
    public function setVideo(Video $video): Bookmark
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Image|Video
     */
    public function getLien()
    {
        return $this->image ?? $this->video;
    }
}
