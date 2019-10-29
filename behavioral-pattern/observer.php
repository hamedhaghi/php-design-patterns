<?php
/*
 / To implement a publish/subscribe behaviour to an object, whenever a “Subject” object changes its state,
 / the attached “Observers” will be notified.
 / It is used to shorten the amount of coupled objects and uses loose coupling instead.
 */

// Observable
// Observer

interface IShoppingCartObserver {
    function addedItem(int $id);
}

// Observable
class ShoppingCart {

    private $observers;

    public function attach(IShoppingCartObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function addItem(int $id)
    {
        // add to cart
        //notify observers/listeners
        $this->notify($id);
    }


    private function notify(int $id)
    {
        foreach ($this->observers as $observer){
            $observer->addedItem($id);
        }
    }


}

// Observer
class ShoppingCartLog implements IShoppingCartObserver {

    public function addedItem(int $id)
    {
        echo "Logged Item: {$id}\n";
    }
}


$cart = new ShoppingCart();
$logger = new ShoppingCartLog();

$cart->attach($logger);

$cart->addItem(1);
$cart->addItem(32);
$cart->addItem(234);