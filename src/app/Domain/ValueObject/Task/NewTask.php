<?php
namespace App\Domain\ValueObject\Task;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Task\TaskUserId;
use App\Domain\ValueObject\Task\TaskCategoryId;
use App\Domain\ValueObject\Task\TaskStatus;
use App\Domain\ValueObject\Task\TaskDeadline;
use App\Domain\ValueObject\Task\TaskContents;

final class NewTask
{
    private $user_id;
    private $category_id;
    private $status;
    private $deadline;
    private $contents;

    public function __construct(TaskUserId $user_id, TaskCategoryId $category_id, TaskStatus $status, TaskDeadline $deadline, TaskContents $contents)
    {
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->status = $status;
        $this->deadline = $deadline;
        $this->contents = $contents;
    }

    public function user_id(): TaskUserId
    {
        return $this->user_id;
    }

    public function category_id(): TaskCategoryId
    {
        return $this->category_id;
    }

    public function status(): TaskStatus
    {
        return $this->status;
    }

    public function deadline(): TaskDeadline
    {
        return $this->deadline;
    }

    public function contents(): TaskContents
    {
        return $this->contents;
    }
}
