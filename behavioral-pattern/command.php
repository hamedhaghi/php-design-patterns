<?php
/*
 / To encapsulate invocation and decoupling.
 / We have an Invoker and a Receiver.
 / This pattern uses a “Command” to delegate the method call against the Receiver and presents the same method “execute”.
 / Therefore, the Invoker just knows to call “execute” to process the Command of the client.
 / The Receiver is decoupled from the Invoker.
 */


// Command
// Receiver
// Invoker Or Requester


interface ICommand
{
    function execute();
}

// Receiver
class Television
{
    public function turnOn()
    {
        echo "Television: turn on";
    }

    public function turnOff()
    {
        echo "Television: turn off";
    }
}

// Command
class PowerOnCommand implements ICommand
{

    private $tv;

    public function __construct(Television $tv)
    {
        $this->tv = $tv;
    }

    function execute()
    {
        $this->tv->turnOn();
    }
}

// Invoker Or Requester
class RemoteControl
{
    private $command;

    public function setCommand (ICommand $command){
        $this->command = $command;
    }

    public function pressButton()
    {
        $this->command->execute();
    }
}

$tv = new Television();
$remote = new RemoteControl();
$powerOnCommand = new PowerOnCommand($tv);

$remote->setCommand($powerOnCommand);
$remote->pressButton();

