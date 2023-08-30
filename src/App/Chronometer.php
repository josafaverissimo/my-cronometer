<?php

namespace Src\App;

use Src\Core\Helpers;

use \PDO;

class Chronometer
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Helpers::connect();
    }

    public function page(): void
    {
        $dateTime = $this->getDateTime();

        echo Helpers::loadView("chronometer", [
            "dateTime" => $dateTime
        ]);
    }

    private function getDateTime(): ?string
    {
        $query = "SELECT * FROM cronometer limit 1";

        $statement = $this->connection->prepare($query);
        $statement->execute();
        $dateTime = $statement->fetchObject();

        if (!empty($dateTime)) {
            return $dateTime->start_time;
        }

        return null;
    }

    public function store($startTime): void
    {

        $query = "INSERT INTO cronometer (start_time) VALUES (:start_time)";

        $statement = $this->connection->prepare($query);
        $statement->bindParam(":start_time", $startTime, PDO::PARAM_STR);
        $statement->execute();
    }
}
