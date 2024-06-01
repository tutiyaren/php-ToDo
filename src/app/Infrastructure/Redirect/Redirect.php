<?php
namespace App\Infrastructure\Redirect;

final class Redirect 
{
    public static function hendler(string $path): void
    {
        header('Location: ' . $path);
        exit();
    }
}
