<?php

namespace App\Normalizer;

use App\Dto\TagOutput;
use App\Entity\Tag;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

/**
 * Class TagOutputNormalizer
 * @package App\Normalizer
 */
class TagOutputNormalizer implements ContextAwareNormalizerInterface
{
    /**
     * @param Tag $tag
     * @param null $format
     * @param array $context
     * @return TagOutput
     */
    public function normalize($tag, $format = null, array $context = [])
    {
        return (new TagOutput())
            ->setLabel($tag->getLabel());
    }

    /**
     * @param mixed $data
     * @param null $format
     * @param array $context
     * @return bool
     */
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Tag;
    }
}
