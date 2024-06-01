<?php
namespace App\Domain\ValueObject\Category;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use APp\Domain\ValueObject\Category\CategoryUserId;
use APp\Domain\ValueObject\Category\CategoryName;


final class NewCategory
{
    private $user_id;
    private $name;

    public function __construct(CategoryUserId $user_id, CategoryName $name)
    {
        $this->user_id = $user_id;
        $this->name = $name;
    }

    public function user_id(): CategoryUserId
    {
        return $this->user_id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }
}