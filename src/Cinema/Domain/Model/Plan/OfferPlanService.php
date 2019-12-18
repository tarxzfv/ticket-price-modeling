<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Order;

interface OfferPlanService
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
    ): PlanCollection;
}