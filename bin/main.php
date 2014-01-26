<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
set_time_limit(0);

$executor = new \ThreadWorker\QueueExecutor($queue = new \ThreadWorker\RedisQueue('scan'));

$queue = new \ThreadWorker\RedisQueue('scan');
$queue->clear();

$logQueue = new \ThreadWorker\RedisQueue('log');
$logQueue->clear();

$executor = new \ThreadWorker\QueueExecutor($queue);
$startTask = new \PassScan\StartScanTask(1, 217, 64);
$executor->execute($startTask);

$worker = new \PassScan\Worker($logQueue);
$worker->work();


