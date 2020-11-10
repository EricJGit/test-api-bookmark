<?php

namespace App\Factory;

use App\Strategy\LienStrategyInterface;

/**
 * Class LienFactory
 * @package App\Factory
 */
class LienFactory
{
    /** @var LienStrategyInterface[] */
    private $lienStrategies;

    /**
     * @param LienStrategyInterface[] $lienStrategies
     */
    public function __construct(iterable $lienStrategies)
    {
        $this->lienStrategies = $lienStrategies;
    }

    /**
     * @param string $type
     *
     * @return LienStrategyInterface
     */
    public function create(string $type): LienStrategyInterface
    {
        foreach ($this->lienStrategies as $lienStrategy) {
            if ($lienStrategy->support($type)) {
                return $lienStrategy;
            }
        }
        throw new \Exception("Type de lien non supporté : ".$type);
    }
}
