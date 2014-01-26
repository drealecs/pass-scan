<?php
namespace PassScan;

use ThreadWorker\Executor;

class ConsoleLog
{
    /**
     * @var Executor
     */
    private $executor;

    public function __construct($executor)
    {
        $this->executor = $executor;
    }


    public function log($text)
    {
        $echoText = number_format(microtime(true), 6, '.', '') . ' > ' . $text;
        $this->executor->execute(new EchoTask($echoText));
    }
}
