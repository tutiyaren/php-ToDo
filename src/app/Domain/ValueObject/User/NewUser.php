<?php
namespace App\Domain\ValueObject\User;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;

final class NewUser
{
    private $name;
    private $email;
    private $password;

    public function __construct(UserName $name, Email $email, InputPassword $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): InputPassword
    {
        return $this->password;
    }
}
