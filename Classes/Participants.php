<?php


require_once "Database.php";

class Participants
{

    public $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll()
    {
        return $this->connection->query("SELECT * FROM participants
        INNER JOIN events on 
        participants.evCode = events.evCode 
        WHERE participants.isDeleted = 0");
    }
    public function create($partId, $evCode, $partFName, $partLName, $partDRate)
    {
        $stmt = $this->connection->prepare("INSERT INTO participants(partId,evCode,partFName,partLName,partDRate )
        VALUES(?,?,?,?,?)");
        $stmt->bind_param("isssi", $partId, $evCode, $partFName, $partLName, $partDRate);
        if ($stmt->execute()) {
            return "Participants created successfully!";
        } else {
            return "Error creating Participants!";
        }
    }

    public function update( $partId, $evCode, $partFName, $partLName, $partDRate)
    {
        $stmt = $this->connection->prepare("UPDATE participants SET partId = ?, evCode = ?,partFName = ?, partLName = ?,partDRate =?  WHERE partId = $partId");
        $stmt->bind_param("isssi", $partId, $evCode, $partFName, $partLName, $partDRate);
        $stmt->execute();
        if ($stmt->execute()) {
            return "Participants updated successfully!";
        } else {
            return "Error updating Participants!";
        }
    }
    public function getById($partId){
        return $this->connection->query("SELECT * FROM participants WHERE isDeleted = 0 AND partId = $partId");
    }
    public function delete($partId)
    {
         $stmt = $this->connection->prepare("UPDATE participants SET isDeleted = ? WHERE partId = $partId");
        $stmt->bind_param("i", $partId);
        $stmt->execute();
        if ($stmt->execute()) {
            return "Participants deleted successfully!";
        } else {
            return "Error deleting Participants!";
        }
    }
    public function search($partId)
    {
        return $this->connection->query("SELECT * FROM participants
        INNER JOIN events on 
        participants.evCode = events.evCode 
        WHERE participants.partId
        LIKE '%$partId%' AND participants.isDeleted = 0");
  
    }
}
