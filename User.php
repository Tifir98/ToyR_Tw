<?php
Class User{
    public $conn;
    public $table='User';
    public $idUser;
    public $email;
    public $pass;
    public $fname;
    public $lname;
    public $address;
    public $type='user';

    public function __construct($db) {
        $this->conn = $db;
      }
      public function Insert() {
        $query = 'INSERT INTO ' .$this->table . ' SET email = :email,parola= :pass,nume= :fname,prenume= :lname,adresa= :address,type=:type';
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(':email', $this->email);
        $stmt-> bindParam(':pass', $this->pass);
        $stmt-> bindParam(':fname', $this->fname);
        $stmt-> bindParam(':lname', $this->lname);
        $stmt-> bindParam(':address', $this->address);
        $stmt-> bindParam(':type', $this->type);

if($stmt->execute()) {
  return true;
}   
printf("Error: $s.\n", $stmt->error);
return false;}

    public function getUser() {
      $query = 'SELECT type FROM ' . $this->table . ' WHERE email= ? and parola = ? ';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(1, $this->email);
      $stmt-> bindParam(2, $this->parola);
      $stmt->execute();

      return $stmt;
    }
    public function getID(){
      $query = 'SELECT id FROM ' . $this->table . ' WHERE email = ?';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(1, $this->email);
      $stmt->execute();
      return $stmt;
    }
    public function getEmail(){
      $query = 'SELECT email FROM ' . $this->table . ' WHERE id = ?';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(1, $this->idUser);
      $stmt->execute();
      return $stmt;
    }

    public function RemoveUser(){
      $query='DELETE FROM ' . $this->table . ' WHERE email=:email and nume=:fname and prenume=:lname and adresa=:adresa';
      $stmt = $this->conn->prepare($query);
      $stmt-> bindParam(':email', $this->email);
      $stmt-> bindParam(':fname', $this->fname);
      $stmt-> bindParam(':lname', $this->lname);
      $stmt-> bindParam(':adresa', $this->address);
      if($stmt->execute()) {
        return true;
      }   
      printf("Error: $s.\n", $stmt->error);
      return false;
    }
}