<?php
/*
 / To separate strategies and to enable fast switching between them.
 / Also this pattern is a good alternative to inheritance (instead of having an abstract class that is extended).
 */

interface Logger
{
    public function log();
}

class LogToFile implements Logger
{

    public function log()
    {
        echo "Logged data to the file";
    }
}

class LogToDatabase implements Logger
{

    public function log()
    {
        echo "Logged data to the database";
    }
}

class LogToWebservice implements Logger
{

    public function log()
    {
        echo "Logged data to the Webservice";
    }
}

class App
{

    public function __construct(Logger $logger)
    {
        $logger->log();
    }
}

(new App(new LogToWebservice()));