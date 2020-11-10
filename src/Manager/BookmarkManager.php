<?php

namespace App\Manager;

use App\Entity\Bookmark;
use App\Entity\Tag;
use App\Factory\LienFactory;
use Doctrine\ORM\EntityManagerInterface;
use Embed\Embed;
use Pagerfanta\Pagerfanta;

/**
 * Class BookmarkManager
 * @package App\Manager
 */
class BookmarkManager
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /** @var Embed */
    private Embed $embed;

    /** @var LienFactory */
    private LienFactory $lienFactory;

    /**
     * BookmarkManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param Embed $embed
     * @param LienFactory $lienFactory
     */
    public function __construct(EntityManagerInterface $entityManager, Embed $embed, LienFactory $lienFactory)
    {
        $this->entityManager = $entityManager;
        $this->embed = $embed;
        $this->lienFactory = $lienFactory;
    }

    /**
     * @param string $uuid
     * @return Bookmark|null
     */
    public function get(string $uuid)
    {
        return $this->entityManager->getRepository(Bookmark::class)->find($uuid);
    }

    /**
     * @param int $start
     * @param int $limit
     * @return Pagerfanta
     */
    public function list(int $start, int $limit)
    {
        return $this->entityManager->getRepository(Bookmark::class)->list($limit, $start);
    }

    /**
     * @param string $url
     * @throws \Exception
     */
    public function createFormUrl(string $url): void
    {
        $bookmark = new Bookmark();

        $info = $this->embed->get($url);
        $oEmbed = $info->getOEmbed();

        $lienStrategy = $this->lienFactory->create($oEmbed->get('type'));

        $lienStrategy->create($bookmark, $oEmbed);

        $this->save($bookmark);
    }

    /**
     * @param Bookmark $bookmark
     */
    public function delete(Bookmark $bookmark): void
    {
        $this->entityManager->remove($bookmark);
        $this->entityManager->flush();
    }

    /**
     * @param Tag $tag
     */
    public function deleteTag(Tag $tag): void
    {
        $this->entityManager->remove($tag);
        $this->entityManager->flush();
    }

    /**
     * @param Bookmark $bookmark
     */
    public function save(Bookmark $bookmark): void
    {
        $this->entityManager->persist($bookmark);
        $this->entityManager->flush();
    }
}
