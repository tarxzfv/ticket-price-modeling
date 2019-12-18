<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

interface PlanRepository
{
    /**
     * @return PlanCollection
     */
    public function findRegularPlansForOffering(): PlanCollection;

    /**
     * @return PlanCollection
     */
    public function findDiscountPlansForOffering(): PlanCollection;
}