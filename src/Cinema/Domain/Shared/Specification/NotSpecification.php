<?php

declare(strict_types=1);

namespace Cinema\Domain\Shared\Specification;

class NotSpecification implements Specification
{
    /**
     * @var Specification
     */
    private $specification;

    /**
     * @param Specification $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    /**
     * @param mixed $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate): bool
    {
        return $this->specification->isSatisfiedBy($candidate) === false;
    }
}
