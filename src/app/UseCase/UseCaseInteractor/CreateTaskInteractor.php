<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\CreateTaskInput;
use App\UseCase\UseCaseOutput\CreateTaskOutput;
use App\Domain\ValueObject\Task\NewTask;
use App\Domain\Entity\Task;
use App\Adapter\Task\TaskMysqlCommand;
use App\Adapter\Task\TaskMysqlQuery;

final class CreateTaskInteractor
{
    const COMPLETED_MESSAGE = 'タスクを追加しました';
    private $input;
    private $taskMysqlCommand;
    private $taskMysqlQuery;

    public function __construct(
        CreateTaskInput $input,
        TaskMysqlQuery $taskMysqlQuery,
        TaskMysqlCommand $taskMysqlCommand
    ) {
        $this->input = $input;
        $this->taskMysqlCommand = new TaskMysqlCommand();
        $this->taskMysqlQuery = new TaskMysqlQuery();
    }

    public function run(): CreateTaskOutput
    {
        if(strlen($this->input->contents()->value()) > 80) {
            return new CreateTaskOutput(false, 'タスクは80文字以内で');
        }
        $this->createTask();
        return new CreateTaskOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createTask(): void
    {
        $this->taskMysqlCommand->insert(
            new NewTask(
                $this->input->user_id(),
                $this->input->category_id(),
                $this->input->status(),
                $this->input->deadline(),
                $this->input->contents(),
            )
        );
    }
}
