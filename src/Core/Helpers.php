<?php

namespace Src\Core;

use \PDO;

class Helpers
{
    public static function loadView($viewPath, $data): string
    {
        ob_start();

        extract($data);

        require __DIR__ . "/../App/views/{$viewPath}.php";

        return ob_get_clean();
    }

    public static function connect(): PDO
    {
        $host = "localhost";
        $dbname = "cronometer";
        $user = "josafaverissimo";
        $password = "root";

        return new PDO(
            "mysql:host=$host;dbname=$dbname",
            $user,
            $password
        );
    }
}
