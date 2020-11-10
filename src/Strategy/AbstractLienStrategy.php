<?php

namespace App\Strategy;

use App\Entity\Lien;
use Doctrine\ORM\EntityManagerInterface;
use Embed\OEmbed;

/**
 * Class AbstractLienStrategy
 * @package App\Strategy
 */
class AbstractLienStrategy
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /**
     * VideoStrategy constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Lien $lien
     * @param OEmbed $oEmbed
     */
    public function createCommon(Lien $lien, OEmbed $oEmbed): void
    {
        $lien
            ->setUrl(ltrim($oEmbed->get('provider_url'), '/').$oEmbed->get('uri'))
            ->setDate(new \DateTime($oEmbed->get('upload_date')))
            ->setAuteur($oEmbed->get('author_name'))
            ->setTitre($oEmbed->get('title'));
    }
}
