<?php

require __DIR__ . "/../vendor/autoload.php";

use Src\App\Chronometer;

$chronometer = new Chronometer();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST) {
        $startTime = filter_var($_POST['start_time'], FILTER_SANITIZE_SPECIAL_CHARS);

        $chronometer->store($startTime);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $chronometer->page();
}
