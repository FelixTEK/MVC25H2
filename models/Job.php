<?php
class Job {
    private $conn;
    private $table_name = "jobs";

    public function __construct($db) {
        $this->conn = $db;
    }

    // ดึงงานทั้งหมดที่สถานะเป็น 'เปิด'
    public function getOpenJobs() {
        $query = "SELECT j.job_id, j.title, j.description, j.deadline, j.type, c.name as company_name
                  FROM " . $this->table_name . " j
                  LEFT JOIN companies c ON j.company_id = c.company_id
                  WHERE j.status = 'เปิด'
                  ORDER BY j.deadline ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>