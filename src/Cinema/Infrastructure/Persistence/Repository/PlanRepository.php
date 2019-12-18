<?php

declare(strict_types=1);

namespace Cinema\Infrastructure\Persistence\Repository;

use Cinema\Domain\Model\Plan\PlanCollection;
use Cinema\Domain\Model\Plan\PlanFactory;
use Cinema\Domain\Model\Plan\PlanRepository as PlanRepositoryInterface;

class PlanRepository implements PlanRepositoryInterface
{
    /**
     * @return PlanCollection
     */
    public function findRegularPlansForOffering(): PlanCollection
    {
        return (new PlanFactory())->createRegularPlanCollection();
    }

    /**
     * @return PlanCollection
     */
    public function findDiscountPlansForOffering(): PlanCollection
    {
        return (new PlanFactory())->createDiscountPlanCollection();
    }
}