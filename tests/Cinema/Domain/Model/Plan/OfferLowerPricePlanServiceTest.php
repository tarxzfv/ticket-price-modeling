<?php

declare(strict_types=1);

namespace Tests\Cinema\Domain\Model\Plan;

use Cinema\Domain\Model\Plan\PlanCollection;
use Cinema\Domain\Model\Plan\OfferLowerPricePlanService;
use Cinema\Domain\Shared\Specification\Specification;
use Tests\Cinema\FixtureTrait;

class OfferLowerPricePlanServiceTest extends \PHPUnit\Framework\TestCase
{
    use FixtureTrait;

    /**
     * @return void
     */
    public function testOfferCinemaCitizenCustomerPlanForOrder(): void
    {
        // シネマシティズン会員によるオーダー
        $order = $this->createOrder($this->createCinemaCitizenCustomer());

        $spec1 = $this->prophesize(Specification::class);
        $spec1->isSatisfiedBy($order)->willReturn(false)->shouldNotBeCalled();

        // プランは安い順にソートしてからオファーされるため、こちらはそもそもコールされない
        $generalPlan = $this->createPlan(1500, $spec1->reveal());

        $spec2 = $this->prophesize(Specification::class);
        $spec2->isSatisfiedBy($order)->willReturn(true)->shouldBeCalled();

        // このプランが選ばれなければならない
        $membershipPlan = $this->createMembershipPlan(1000, $spec2->reveal());

        $service = new OfferLowerPricePlanService();

        $actual = $service->offerPlanForOrder(
            $order,
            new PlanCollection($generalPlan, $membershipPlan),
            new PlanCollection($this->createPlan())
        );

        // シネマシティズン会員なら適用されるプランは一意に定まる
        $expected = new PlanCollection($membershipPlan);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testOfferGeneralPlanForOrder(): void
    {
        // 非会員によるオーダー
        $order = $this->createOrder($this->createCustomer());

        $spec1 = $this->prophesize(Specification::class);
        $spec1->isSatisfiedBy($order)->willReturn(true)->shouldBeCalled();

        // このプランが選ばれなければならない
        $generalPlan = $this->createPlan(1500, $spec1->reveal());

        $spec2 = $this->prophesize(Specification::class);
        $spec2->isSatisfiedBy($order)->willReturn(false)->shouldBeCalled();

        // このプランは選ばれてはいけない
        $membershipPlan = $this->createMembershipPlan(1000, $spec2->reveal());

        // 各種割引プランとして提案されるべきプラン
        $discountPlan = $this->createPlan();

        $service = new OfferLowerPricePlanService();

        $actual = $service->offerPlanForOrder(
            $order,
            new PlanCollection($generalPlan, $membershipPlan),
            new PlanCollection($discountPlan)
        );

        // 非会員によるオーダーの場合は適用できるプランのうち
        // もっとも安いものと代替プランが提案される
        $expected = new PlanCollection($generalPlan, $discountPlan);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testOfferGeneralPlanForOrderNotFound(): void
    {
        $order = $this->createOrder($this->createCustomer());

        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy($order)->willReturn(false)->shouldBeCalled();

        $generalPlan  = $this->createPlan(null, $spec->reveal());
        $discountPlan = $this->createPlan();

        $service = new OfferLowerPricePlanService();

        $actual = $service->offerPlanForOrder(
            $order,
            new PlanCollection($generalPlan),
            new PlanCollection($discountPlan)
        );

        // 主要プランから適用できるプランが見当たらない場合は、
        // 代替プランをマージしたコレクションをそのまま提案する
        $expected = new PlanCollection($generalPlan, $discountPlan);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testOfferGeneralPlanWithoutOptionalForOrder(): void
    {
        $order = $this->createOrder($this->createCustomer());

        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy($order)->willReturn(true)->shouldBeCalled();

        $plan = new PlanCollection($this->createPlan(null, $spec->reveal()));

        $service = new OfferLowerPricePlanService();

        $actual = $service->offerPlanForOrder($order, $plan);

        // 主要プランから適用できるプランが見当たらない、かつ代替プランがない場合は、
        // 主要プランのコレクションをそのまま提案する
        $expected = $plan;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function testOfferGeneralPlanWithoutOptionalForOrderNotFound(): void
    {
        $order = $this->createOrder($this->createCustomer());

        $spec = $this->prophesize(Specification::class);
        $spec->isSatisfiedBy($order)->willReturn(false)->shouldBeCalled();

        $plan = new PlanCollection($this->createPlan(null, $spec->reveal()));

        $service = new OfferLowerPricePlanService();

        $actual = $service->offerPlanForOrder($order, $plan);

        // 主要プランから適用できるプランが見当たらない、かつ代替プランがない場合は、
        // 主要プランのコレクションをそのまま提案する
        $expected = $plan;

        $this->assertEquals($expected, $actual);
    }
}
