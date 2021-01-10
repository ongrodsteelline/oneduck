<?php

namespace App\Modules\Woocommerce\Checkout;

class Order
{
    protected $isDelivery = false;
    protected $address;
    protected $payment;
    protected $comment;

    public function __construct()
    {

    }

    /**
     * @return bool
     */
    public function isDelivery()
    {
        return $this->isDelivery;
    }

    public function enableDelivery()
    {
        $this->isDelivery = true;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param  mixed  $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param  mixed  $payment
     */
    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param  mixed  $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }
}