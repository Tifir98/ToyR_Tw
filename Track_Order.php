<?php
class Track{
    public $conn;
    public $idOrder;
    public $table = 'Track_order';
    public $placed_at;
    public $status;
    public function __construct($db) {
        $this->conn = $db;
      }

    public function Update(){
        $sql = 'UPDATE '.$this->table.' SET status = :status , placed_at = :placed_at WHERE id = :id ';
        $stmt =$this->conn->prepare($sql);
        $stmt->bindParam(':id',$this->idOrder);
        $this->placed_at=date("Y/m/d");
        $stmt->bindParam(':placed_at',$this->placed_at);
        $stmt->bindParam(':status',$this->status);
        $stmt->execute();
        
    }
}
?>