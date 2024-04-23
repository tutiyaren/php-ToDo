<?php
namespace App\Adapter\Task;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\TaskDao;
use App\Domain\ValueObject\Task\NewTask;

class TaskMysqlCommand
{
    private $taskDao;

    public function __construct()
    {
        $this->taskDao = new TaskDao();
    }

    public function insert(NewTask $task): void
    {
        $this->taskDao->create($task);
    }
}