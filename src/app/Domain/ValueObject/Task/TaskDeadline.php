<?php
namespace App\Domain\ValueObject\Task;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use Exception;

final class TaskDeadline
{
     const INVALID_MESSAGE = '不正な値です';

    private $value;

    public function __construct(string $value)
    {
        if($this->isInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function isInvalid(string $value): bool
    {
        return !strtotime($value);
    }
}
