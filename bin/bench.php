<?php
set_time_limit(0);
require_once dirname(__DIR__) . '/vendor/autoload.php';

$executor = new \ThreadWorker\QueueExecutor($queue = new \ThreadWorker\RedisQueue('bench'));

$queue->clear();
$start = microtime(true);
$queuedTasks = array();
for ($i = 1; $i < 10000; $i++) {
    $queuedTasks[] = $executor->submit(new \PassScan\BenchTask('arg1', array('andTheSecond')));
}
foreach ($queuedTasks as $queuedTask) {
    $queuedTask->getResult()->getValue();
}
$end = microtime(true);
echo "10k time: " . ($end - $start) . "\n";
$queue->clear();
