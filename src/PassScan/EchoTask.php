<?php
namespace PassScan;

class EchoTask extends Task
{
    public function run($text)
    {
        echo $text . PHP_EOL;
    }
}
