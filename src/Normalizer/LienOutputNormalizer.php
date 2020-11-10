<?php

namespace App\Normalizer;

use App\Dto\LienOutput;
use App\Entity\Bookmark;
use App\Entity\Video;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

/**
 * Class LienOutputNormalizer
 * @package App\Normalizer
 */
class LienOutputNormalizer implements ContextAwareNormalizerInterface
{
    /**
     * @param Bookmark $bookmark
     * @param null $format
     * @param array $context
     * @return LienOutput
     */
    public function normalize($bookmark, $format = null, array $context = [])
    {
        $lien = $bookmark->getLien();

        $lienOutput = (new LienOutput())
            ->setUrl($lien->getUrl())
            ->setTitre($lien->getTitre())
            ->setAuteur($lien->getAuteur())
            ->setDate($lien->getDate()->format("Y-m-d H:i:s"))
            ->setLargeur($lien->getLargeur())
            ->setHauteur($lien->getHauteur());

        if ($lien instanceof Video) {
            $lienOutput
                ->setDuree($lien->getDuree());
        }

        return $lienOutput;
    }

    /**
     * @param mixed $data
     * @param null $format
     * @param array $context
     * @return bool
     */
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Bookmark;
    }
}
