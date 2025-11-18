<?php
require_once 'Database.php';

class Users
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAll()
    {
        return $this->connection->query("SELECT * FROM users WHERE isDeleted = 0");
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users 
        WHERE userId = ? AND isDeleted = 0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($username, $password, $fullname, $email, $role)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->connection->prepare(
            "INSERT INTO users(username, passwordHash, fullname, email, role) 
            VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $username, $passwordHash, $fullname, $email, $role);

        if ($stmt->execute()) {
            return "User created successfully";
        } else {
            return "Error creating user: " . $stmt->error;
        }
    }

    public function update($userId, $username, $password, $fullname, $email, $role)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->connection->prepare(
            "UPDATE users SET username = ?, passwordHash = ?, fullname = ?, email = ?, role = ? WHERE userId = ?"
        );
        $stmt->bind_param("sssssi", $username, $passwordHash, $fullname, $email, $role, $userId);

        if ($stmt->execute()) {
            return "User updated successfully";
        } else {
            return "Error updating user: " . $stmt->error;
        }
    }

    // Search users by username
    public function searchUsers($username)
    {
        $username = $this->connection->real_escape_string($username);
        return $this->connection->query("SELECT * FROM users WHERE username LIKE '%$username%' AND isDeleted = 0");
    }

    // Logical delete
    public function delete($userId)
    {
        $stmt = $this->connection->prepare("UPDATE users SET isDeleted = 1 WHERE userId = ?");
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            return "User deleted successfully";
        } else {
            return "Error deleting user: " . $stmt->error;
        }
    }

    // Login method
    public function login($username, $password)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ? AND isDeleted = 0");
        $stmt->bind_param("s", $username); //bind username 
        $stmt->execute();
        $result = $stmt->get_result(); // store the result using get_result();

        if ($result->num_rows === 1) { //check if num or rows = 1
            $user = $result->fetch_assoc(); // fetch by array
            if (password_verify($password, $user['passwordHash'])) { // verify password
                return $user; //return
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    }
}
