<?php
namespace PassScan;

use ThreadWorker\Task;

class BenchTask extends Task
{
    protected function run($param1, $param2)
    {
        return 'BenchResult';
    }
}
