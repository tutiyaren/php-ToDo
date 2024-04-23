<?php
namespace App\Domain\Entity;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Category\CategoryId;
use App\Domain\ValueObject\Category\CategoryUserId;
use App\Domain\ValueObject\Category\CategoryName;

final class Category
{
    private $id;
    private $user_id;
    private $name;

    public function __construct(CategoryId $id, CategoryUserId $user_id, CategoryName $name)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
    }

    public function id(): CategoryId
    {
        return $this->id;
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
