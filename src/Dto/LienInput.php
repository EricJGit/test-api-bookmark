<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Bookmark
 * @package App\Dto
 */
class LienInput
{
    /**
     * @var string
     *
     * @Assert\Url()
     * @Assert\NotBlank()
     */
    private string $url;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return LienInput
     */
    public function setUrl(string $url): LienInput
    {
        $this->url = $url;

        return $this;
    }
}
