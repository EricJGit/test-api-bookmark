<?php

namespace App\Tests\Manager;

use App\Factory\LienFactory;
use App\Manager\BookmarkManager;
use App\Strategy\LienStrategyInterface;
use Doctrine\ORM\EntityManagerInterface;
use Embed\Embed;
use Embed\Extractor;
use Embed\OEmbed;
use PHPUnit\Framework\TestCase;

/**
 * Class BookmarkManagerTest
 * @package App\Tests\Manager
 */
class BookmarkManagerTest extends TestCase
{
    /** @var BookmarkManager */
    private $sut;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var Embed */
    private $embed;

    /** @var LienFactory */
    private $lienFactory;

    /**
     */
    public function setUp()
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->embed = $this->createMock(Embed::class);
        $this->lienFactory = $this->createMock(LienFactory::class);

        $this->sut = new BookmarkManager($this->entityManager, $this->embed, $this->lienFactory);
    }

    /**
     */
    public function test_createFormUrl()
    {
        $info = $this->createMock(Extractor::class);
        $lienStrategy = $this->createMock(LienStrategyInterface::class);
        $oEmbed = $this->createMock(OEmbed::class);

        $url = "https://vimeo.com/23846442";
        $type = "video";

        $oEmbed->expects($this->once())
            ->method('get')
            ->with('type')
            ->willReturn($type);

        $this->embed->expects($this->once())
            ->method('get')
            ->with($url)
            ->willReturn($info);

        $info->expects($this->once())
            ->method('getOEmbed')
            ->willReturn($oEmbed);

        $this->lienFactory->expects($this->once())
            ->method('create')
            ->with($type)
            ->willReturn($lienStrategy);

        $lienStrategy->expects($this->once())
            ->method('create');

        $this->sut->createFormUrl($url);
    }

    /**
     */
    public function teearDown()
    {
        $this->sut = null;
        $this->entityManager = null;
        $this->embed = null;
        $this->lienFactory = null;
    }
}
