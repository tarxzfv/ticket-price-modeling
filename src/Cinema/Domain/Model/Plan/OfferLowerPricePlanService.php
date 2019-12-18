<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Order;

class OfferLowerPricePlanService implements OfferPlanService
{
    /**
     * @param Order $order
     * @param PlanCollection $plans
     * @param PlanCollection|null $optional
     * @return PlanCollection
     */
    public function offerPlanForOrder(
        Order $order,
        PlanCollection $plans,
        PlanCollection $optional = null
    ): PlanCollection {
        $found = $plans->sortByPriceFromLowToHigh()
                        ->findSatisfiablePlanByOrder($order);

        if ($found === null) {
            return $optional !== null ? $plans->merge($optional) : $plans;
        }

        $offers = new PlanCollection($found);

        if ($found->isMembershipPlan()) {
            return $offers;
        }

        return $optional !== null ? $offers->merge($optional) : $offers;
    }
}