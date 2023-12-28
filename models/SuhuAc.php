<?php
class SuhuAc{
    // Connection
    private $conn;
    // Table
    private $db_table = "suhu_ac";
    // Columns
    public $id;
    public $suhu_min;
    public $suhu_mid;
    public $suhu_max;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getAll(){
        $sqlQuery = "SELECT id, suhu_min, suhu_mid, suhu_max FROM ". $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createData(){
        $sqlQuery = "INSERT INTO ". $this->db_table ."
        SET
        suhu_min = :suhu_min,
        suhu_mid = :suhu_mid,
        suhu_max = :suhu_max";
        $stmt = $this->conn->prepare($sqlQuery);
            // sanitize
            $this->suhu_min=htmlspecialchars(strip_tags($this->suhu_min));
            $this->suhu_mid=htmlspecialchars(strip_tags($this->suhu_mid));
            $this->suhu_max=htmlspecialchars(strip_tags($this->suhu_max));
            // bind data
            $stmt->bindParam(":suhu_min", $this->suhu_min);
            $stmt->bindParam(":suhu_mid", $this->suhu_mid);
            $stmt->bindParam(":suhu_max", $this->suhu_max);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    // READ single
    public function getSingleData(){
        $sqlQuery = "SELECT
        id,
        suhu_min,
        suhu_mid,
        suhu_max      
        FROM
        ". $this->db_table ."
        WHERE
        id = ?
        LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->suhu_min = $dataRow['suhu_min'];
        $this->suhu_mid = $dataRow['suhu_mid'];
        $this->suhu_max = $dataRow['suhu_max'];
    }
    // UPDATE
    public function updateData(){
        $sqlQuery = "UPDATE
        ". $this->db_table ."
        SET
        suhu_min = :suhu_min,
        suhu_mid = :suhu_mid,
        suhu_max = :suhu_max 
        WHERE
        id = :id";
        $stmt = $this->conn->prepare($sqlQuery);
        
        $this->suhu_min=htmlspecialchars(strip_tags($this->suhu_min));
        $this->suhu_mid=htmlspecialchars(strip_tags($this->suhu_mid));
        $this->suhu_max=htmlspecialchars(strip_tags($this->suhu_max));
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind data
        $stmt->bindParam(":suhu_min", $this->suhu_min);
        $stmt->bindParam(":suhu_mid", $this->suhu_mid);
        $stmt->bindParam(":suhu_max", $this->suhu_max);
        $stmt->bindParam(":id", $this->id);
        $stmt->fetchAll();

        try {
            $stmt->execute();
        }
        catch(PDOException $exception) {
            die($exception->getMessage());
        }
        
        if (count($stmt->fetchAll()) == 0) {
            return true;
        }
    }
    // DELETE
    function deleteData(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function generateByAVG(){
        $sqlQuery = "SELECT
        AVG(suhu_min) AS r_min, 
        AVG(suhu_mid) AS r_mid, 
        AVG(suhu_max) AS r_max 
        FROM  
        ". $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->suhu_min = $dataRow['r_min'];
        $this->suhu_mid = $dataRow['r_mid'];
        $this->suhu_max = $dataRow['r_max'];
    }

    public function generateByAVGs(){
        $sqlQuery = "SELECT
        AVG(suhu_min) AS r_min, 
        AVG(suhu_mid) AS r_mid, 
        AVG(suhu_max) AS r_max   
        FROM 
        ". $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->suhu_min = $dataRow['r_min'];
        $this->suhu_mid = $dataRow['r_mid'];
        $this->suhu_max = $dataRow['r_max'];
    }
}
?>