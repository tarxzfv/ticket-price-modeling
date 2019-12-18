<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Order;

class PlanCollection
{
    /**
     * @var string
     */
    private const ASC = 'asc';

    /**
     * @var string
     */
    private const DESC = 'desc';

    /**
     * @var Plan[]
     */
    private $plans;

    /**
     * @param Plan|null ...$plans
     */
    public function __construct(?Plan ...$plans)
    {
        $this->plans = !empty(array_filter($plans)) ? $plans : [];
    }

    /**
     * @return Plan[]
     */
    public function all(): array
    {
        return $this->plans;
    }

    /**
     * @param PlanCollection $another
     * @return PlanCollection
     */
    public function merge(PlanCollection $another): self
    {
        $plans = array_merge($this->plans, $another->all());

        return new self(...$plans);
    }

    /**
     * @param Order $order
     * @return Plan|null
     */
    public function findSatisfiablePlanByOrder(Order $order): ?Plan
    {
        $result = null;

        foreach ($this->plans as $plan) {
            if ($plan->isSatisfiedBy($order)) {
                $result = $plan;
                break;
            }
        }

        return $result;
    }

    /**
     * @return PlanCollection
     */
    public function sortByPriceFromLowToHigh(): self
    {
        return $this->sortByPrice(self::ASC);
    }

    /**
     * @return PlanCollection
     */
    public function sortByPriceFromHighToLow(): self
    {
        return $this->sortByPrice(self::DESC);
    }

    /**
     * @param string $orderBy
     * @return PlanCollection
     */
    private function sortByPrice($orderBy): self
    {
        if (empty($this->plans)) {
            return $this;
        }

        if ($orderBy === self::ASC) {
            $func = function (Plan $a, Plan $b): int {
                return $a->price() <=> $b->price();
            };
        } else {
            $func = function (Plan $a, Plan $b): int {
                return $b->price() <=> $a->price();
            };
        }

        $plans = $this->plans;

        usort($plans, $func);

        return new self(...$plans);
    }
}
