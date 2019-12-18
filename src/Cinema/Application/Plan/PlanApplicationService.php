<?php

declare(strict_types=1);

namespace Cinema\Application\Plan;

use Cinema\Domain\Model\Order;
use Cinema\Domain\Model\Plan\OfferPlanService;
use Cinema\Domain\Model\Plan\PlanCollection;
use Cinema\Domain\Model\Plan\PlanRepository;

class PlanApplicationService
{
    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * @var OfferPlanService
     */
    private $offerPlanService;

    /**
     * @param PlanRepository $planRepository
     * @param OfferPlanService $offerPlanService
     */
    public function __construct(
        PlanRepository $planRepository,
        OfferPlanService $offerPlanService
    ) {
        $this->planRepository = $planRepository;
        $this->offerPlanService = $offerPlanService;
    }

    /**
     * @param Order $order
     * @return PlanCollection
     */
    public function offerPlans(Order $order): PlanCollection
    {
        return $this->offerPlanService->offerPlanForOrder(
            $order,
            $this->planRepository->findRegularPlansForOffering(),
            $this->planRepository->findDiscountPlansForOffering()
        );
    }
}