<?php
namespace PassScan;

use Rhumsaa\Uuid\Uuid;
use ThreadWorker\RemoteExecutor;

class Worker extends RemoteExecutor
{

    /**
     * @var ConsoleLog
     */
    private $logService;

    private $workerID;

    public function __construct($queue)
    {
        parent::__construct($queue);
        $this->workerID = substr(Uuid::uuid4(), -8);
    }

    /**
     * @param ConsoleLog $logger
     * @return Worker
     */
    public function setLogger($logger)
    {
        $this->logService = $logger;
        return $this;
    }

    /**
     * @param string $text
     */
    public function log($text)
    {
        if (isset($this->logService)) {
            $this->logService->log('WORK-' . $this->workerID . ' > ' . $text);
        }
    }

    protected function startTask()
    {
        $this->log('START: QueueStart');
        $task =  parent::startTask();
        $this->log('END: QueueStart');
        return $task;
    }

    protected function runTask($remoteTask)
    {
        $task = $remoteTask->getTask();
        if (isset($this->logService) && ($task instanceof Task)) {
            $task->setLogger($this->logService);
        }
        $this->log('START: TaskRun');
        parent::runTask($remoteTask);
        $this->log('END: TaskRun');
    }

    protected function endTask($task)
    {
        $this->log('START: QueueEnd');
        parent::endTask($task);
        $this->log('END: QueueEnd');
    }

}
