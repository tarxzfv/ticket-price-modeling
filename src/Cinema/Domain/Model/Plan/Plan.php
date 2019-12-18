<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Order;
use Cinema\Domain\Shared\Specification\Specification;

class Plan
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Price
     */
    protected $price;

    /**
     * @var Specification
     */
    protected $spec;

    /**
     * @param string $name
     * @param Price $price
     * @param Specification $spec
     */
    public function __construct(string $name, Price $price, Specification $spec)
    {
        $this->name = $name;
        $this->price = $price;
        $this->spec = $spec;
    }

    /**
     * @return Price
     */
    public function price(): Price
    {
        return $this->price;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function isSatisfiedBy(Order $order): bool
    {
        return $this->spec->isSatisfiedBy($order);
    }

    /**
     * @return bool
     */
    public function isMembershipPlan(): bool
    {
        return false;
    }
}
