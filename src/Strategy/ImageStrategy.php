<?php

namespace App\Strategy;

use App\Entity\Bookmark;
use App\Entity\Image;
use Embed\OEmbed;

/**
 * Class ImageStrategy
 * @package App\Strategy
 */
class ImageStrategy extends AbstractLienStrategy implements LienStrategyInterface
{
    const IMAGE_TYPE = "photo";

    /**
     * @inheritDoc
     */
    public function support(string $type): bool
    {
        return self::IMAGE_TYPE === $type;
    }

    /**
     * @inheritDoc
     */
    public function create(Bookmark $bookmark, OEmbed $oEmbed): void
    {
        $image = (new Image())
            ->setLargeur($oEmbed->get('width'))
            ->setHauteur($oEmbed->get('height'));

        $bookmark->setImage($image);

        parent::createCommon($image, $oEmbed);
    }
}
