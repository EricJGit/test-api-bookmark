<?php

namespace App\Strategy;

use App\Entity\Bookmark;
use App\Entity\Video;
use Embed\OEmbed;

/**
 * Class VideoStrategy
 * @package App\Strategy
 */
class VideoStrategy extends AbstractLienStrategy implements LienStrategyInterface
{
    const VIDEO_TYPE = "video";

    /**
     * @inheritDoc
     */
    public function support(string $type): bool
    {
        return self::VIDEO_TYPE === $type;
    }

    /**
     * @inheritDoc
     */
    public function create(Bookmark $bookmark,OEmbed $oEmbed): void
    {
        $video = (new Video())
            ->setLargeur($oEmbed->get('width'))
            ->setHauteur($oEmbed->get('height'))
            ->setDuree($oEmbed->get('duration'));

        $bookmark->setVideo($video);

        parent::createCommon($video, $oEmbed);
    }
}
