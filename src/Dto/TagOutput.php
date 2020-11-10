<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TagOutput
 * @package App\Dto
 */
class TagOutput implements \JsonSerializable
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private string $label;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return TagOutput
     */
    public function setLabel(string $label): TagOutput
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
