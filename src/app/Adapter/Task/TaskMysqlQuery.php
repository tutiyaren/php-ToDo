<?php
namespace App\Adapter\Task;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\TaskDao;

class TaskMysqlQuery
{
    private $TaskDao;

    public function __construct()
    {
        $this->TaskDao = new TaskDao();
    }
}
