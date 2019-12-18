<?php

declare(strict_types=1);

namespace Cinema\Domain\Shared\Specification;

abstract class CompositeSpecification implements Specification
{
    /**
     * @var Specification[]
     */
    protected $specifications = [];

    /**
     * @param Specification ...$specifications
     */
    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * @param mixed $candidate
     * @return bool
     */
    abstract public function isSatisfiedBy($candidate): bool;
}
