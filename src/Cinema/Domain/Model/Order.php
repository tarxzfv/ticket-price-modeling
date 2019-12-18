<?php

declare(strict_types=1);

namespace Cinema\Domain\Model;

use Cinema\Domain\Model\Customer\Customer;
use Cinema\Domain\Model\Showtime\Showtime;

class Order
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var Showtime
     */
    private $showtime;

    /**
     * @param Customer $customer
     * @param Showtime $showtime
     */
    public function __construct(Customer $customer, Showtime $showtime)
    {
        $this->customer = $customer;
        $this->showtime = $showtime;
    }

    /**
     * @return Customer
     */
    public function customer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Showtime
     */
    public function showtime(): Showtime
    {
        return $this->showtime;
    }
}
