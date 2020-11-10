<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TagInput
 * @package App\Dto
 */
class TagInput
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
     * @return TagInput
     */
    public function setLabel(string $label): TagInput
    {
        $this->label = $label;

        return $this;
    }
}
