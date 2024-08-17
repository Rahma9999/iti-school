<?php
class DB{
    public $conn = "";
    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=iti-school;", "root", "");
    }

    public function insert($data, $value){
        $data = implode(',', $data);
        $value = "'" . implode("','", $value) . "'";
        $sql = "INSERT INTO student ($data) VALUES ($value)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM student WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function show($id){
        $sql = "SELECT * FROM student WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt;
    }
}
?>