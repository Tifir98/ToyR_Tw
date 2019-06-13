<?<?php
  class Login {
    public $conn;
    public $table = 'User';
    public $email;
    public $parola;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function getUser() {
      $query = 'SELECT type FROM ' . $this->table . ' WHERE email= ? and parola = ? ';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(1, $this->email);
      $stmt-> bindParam(2, $this->parola);
      $stmt->execute();

      return $stmt;
    }
  }
