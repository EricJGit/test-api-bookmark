<?php

namespace App\Strategy;

use App\Entity\Bookmark;
use Embed\OEmbed;

interface LienStrategyInterface
{
    /**
     * @param string $type
     * @return bool
     */
    public function support(string $type): bool;

    /**
     * @param Bookmark $bookmark
     * @param OEmbed $oEmbed
     */
    public function create(Bookmark $bookmark,OEmbed $oEmbed): void;
}
