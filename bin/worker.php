<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
set_time_limit(0);

$queue = new \ThreadWorker\RedisQueue('scan');
$executor = new \ThreadWorker\QueueExecutor($queue);

$worker = new \PassScan\Worker($queue);

$logQueue = new \ThreadWorker\RedisQueue('log');
$logExecutor = new \ThreadWorker\QueueExecutor($logQueue);
$logger = new \PassScan\ConsoleLog($logExecutor);
$worker->setLogger($logger);

$worker->work();
