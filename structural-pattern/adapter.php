<?php
/*
	/ An adapter allows two incompatible interfaces to work together.
    / This is the real-world definition for an adapter.
    / Interfaces may be incompatible, but the inner functionality should suit the need.
    / The adapter design pattern allows otherwise incompatible classes to work together by
    / converting the interface of one class into an interface expected by the clients.
*/

interface NovaAdapterInterface
{
    public function pay($amount);

    public function verify($transId);
}

class NovaPayment implements NovaAdapterInterface
{

    public function pay($amount)
    {
        return "Nova Payment is paying {$amount}";
    }

    public function verify($transId)
    {
        return "Nova Payment is verifying {$transId}";
    }
}

interface MagnumPaymentInterface
{
    public function makePay($amount);

    public function makeVerify($trackId);
}

class MagnumPayment implements MagnumPaymentInterface
{
    public function makePay($amount)
    {
        return "Magnum Payment is paying {$amount}";
    }

    public function makeVerify($trackId)
    {
        return "Magnum Payment is verifying {$trackId}";
    }
}

class MagnumPaymentAdapter implements NovaAdapterInterface {

    protected $magnumPayment;

    public function __construct(MagnumPayment $magnumPayment)
    {
        $this->magnumPayment = $magnumPayment;
    }

    public function pay($amount)
    {
        return $this->magnumPayment->makePay($amount);
    }

    public function verify($transId)
    {
        return $this->magnumPayment->makeVerify($transId);
    }
}


class Person
{
    public function pay(NovaAdapterInterface $payment)
    {
       echo $payment->pay(500);
    }
}

(new Person())->pay(new MagnumPaymentAdapter(new MagnumPayment()));



