<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getUserByUsername($username)
    {
        $username = $this->db->real_escape_string($username);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function getUserByEmail($email)
    {
        $email = $this->db->real_escape_string($email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function getUserById($id)
    {
        $id = (int)$id;
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function registerUser($username, $email, $password)
    {
        $username = $this->db->real_escape_string($username);
        $email = $this->db->real_escape_string($email);
        $password = password_hash($password, PASSWORD_ARGON2I);

        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        return $this->db->query($query);
    }

    public function authenticateUser($username, $password)
    {
        $user = $this->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function updateUser($id, $data)
    {
        $id = (int)$id;
        $updateQuery = "UPDATE users SET ";
        foreach ($data as $key => $value) {
            $updateQuery .= "$key = '" . $this->db->real_escape_string($value) . "', ";
        }
        $updateQuery = rtrim($updateQuery, ', ');
        $updateQuery .= " WHERE id = $id";
        return $this->db->query($updateQuery);
    }

    public function deleteUser($id)
    {
        $id = (int)$id;
        $query = "DELETE FROM users WHERE id = $id";
        return $this->db->query($query);
    }
}
