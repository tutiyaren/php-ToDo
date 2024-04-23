<?php
namespace App\Domain\ValueObject\Category;
use Exception;

final class CategoryName
{
    const INVALID_MESSAGE = 'カテゴリ名は20文字以内でお願い';

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

    public function isInvalid(string $value): bool
    {
        return mb_strlen($value) > 20;
    }
}
