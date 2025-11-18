<?php


require_once "Database.php";

class Event
{

    public $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll()
    {
        return $this->connection->query("SELECT * FROM events WHERE isDeleted = 0 ");
    }
    public function create($eventCode, $evName, $evDate, $evVenue, $evRFee)
    {
        $stmt = $this->connection->prepare("INSERT INTO events(evCode,evName,evDate,evVenue,evRFee)
        VALUES(?,?,?,?,?)");
        $stmt->bind_param("isssi", $eventCode, $evName, $evDate, $evVenue, $evRFee);
        if ($stmt->execute()) {
            return "Event created successfully!";
        } else {
            return "Error creating event!";
        }
    }


    public function update($evCode, $evName, $evDate, $evVenue, $evRFee)
    {
        $stmt = $this->connection->prepare("UPDATE events SET evCode = ?, evName = ?,evDate = ?,evVenue = ?,evRFee = ? WHERE evCode = $evCode");
        $stmt->bind_param("isssi", $evCode, $evName, $evDate, $evVenue, $evRFee);
        if ($stmt->execute()) {
            return "Event updated successfully!";
        } else {
            return "Error updating event!";
        }
    }
    public function getById($evCode)
    {
        return $this->connection->query("SELECT * FROM events WHERE isDeleted = 0 AND evCode = $evCode");
    }
    public function delete($evCode)
    {
        return $this->connection->query("UPDATE events SET isDeleted = 1 WHERE evCode = $evCode");
    }

    public function search($evCode)
    {
        return $this->connection->query("SELECT * FROM events WHERE evCode LIKE '%$evCode%' AND isDeleted = 0");
    }
}
