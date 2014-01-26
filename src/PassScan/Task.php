<?php
namespace PassScan;

use Rhumsaa\Uuid\Uuid;
use ThreadWorker\Task as BaseTask;

abstract class Task extends BaseTask
{

    /**
     * @var DatabaseService
     */
    private $databaseService;

    /**
     * @var ConsoleLog
     */
    private $logService;

    private $taskID;

    protected function init()
    {
        $this->databaseService = DatabaseService::getInstance();
        $this->taskID = substr(Uuid::uuid4(), -10);
    }

    /**
     * @return DatabaseService
     */
    protected function db()
    {
        return $this->databaseService;
    }

    /**
     * @param ConsoleLog $logger
     * @return Task
     */
    public function setLogger($logger)
    {
        $this->logService = $logger;
        return $this;
    }

    /**
     * @param string $text
     */
    protected function log($text)
    {
        if (isset($this->logService)) {
            $this->logService->log('TASK-' . $this->taskID . ' > ' . $text);
        }
    }

}
