<?php
/*
 / To build a chain of objects to handle a call in sequential order.
 / If one object cannot handle a call, it delegates the call to the next in the chain and so forth.
 */

abstract class LogType
{
    const Information = 0;
    const Debug = 1;
    const Error = 2;
}

abstract class AbstractLog
{

    protected $level;
    private $nexLogger = null;

    public function setNext(AbstractLog $logger)
    {
        $this->nexLogger = $logger;
    }

    public function log(int $level, string $message)
    {
        if ($this->level <= $level) {
            $this->write($message);
        }

        if ($this->nexLogger != null) {
            $this->nexLogger->log($level, $message);
        }
    }

    abstract protected function write(string $message);
}

class ConsoleLog extends AbstractLog
{

    public function __construct(int $logLevel)
    {
        $this->logLevel = $logLevel;
    }

    protected function write(string $message)
    {
        echo "Console $message\n";
    }
}


class FileLog extends AbstractLog
{

    public function __construct(int $logLevel)
    {
        $this->logLevel = $logLevel;
    }

    protected function write(string $message)
    {
        echo "FileLog $message\n";
    }
}


class EventLog extends AbstractLog
{

    public function __construct(int $logLevel)
    {
        $this->logLevel = $logLevel;
    }

    protected function write(string $message)
    {
        echo "EventLog $message\n";
    }
}


class AppLog {

    private $logChain;
    
    public function __construct()
    {

        $console = new ConsoleLog(LogType::Information);
        $debug = new FileLog(LogType::Debug);
        $error = new EventLog(LogType::Error);

        $console->setNext($debug);
        $debug->setNext($error);

        $this->logChain = $console;
    }

    public function log(int $level, string $message)
    {
        $this->logChain->log($level, $message);
    }

}


$app = new AppLog();
$app->log(LogType::Information, 'This is information');
$app->log(LogType::Debug, 'This is debug');
$app->log(LogType::Error, 'This is error');


