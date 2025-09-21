<?php
class Job {
    private $conn;
    private $table_name = "jobs";

    public function __construct($db) {
        $this->conn = $db;
    }

    // ========== เพิ่มฟังก์ชันใหม่ตรงนี้ ==========
    /**
     * อัปเดตสถานะของงานที่หมดอายุไปแล้วให้เป็น 'ปิด'
     * ฟังก์ชันนี้จะทำงานเหมือน Cron Job จำลอง
     */
    public function updateExpiredJobsStatus() {
        $query = "UPDATE " . $this->table_name . " 
                SET status = 'ปิด' 
                WHERE deadline < CURDATE() AND status = 'เปิด'";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // เราไม่จำเป็นต้องคืนค่าอะไรกลับไป เพราะมันแค่การ UPDATE
        return;
    }
    
    // =======================================

    // ดึงงานทั้งหมดที่สถานะเป็น 'เปิด'
    public function getOpenJobs($sortBy = 'deadline', $sortOrder = 'ASC') {
        // ป้องกันค่าที่ไม่ถูกต้อง
        $allowedSortBy = ['title', 'company_name', 'deadline'];
        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'deadline'; // ค่า default
        }

        $query = "SELECT j.job_id, j.title, j.description, j.deadline, j.type, c.name as company_name
                FROM " . $this->table_name . " j
                LEFT JOIN companies c ON j.company_id = c.company_id
                WHERE j.status = 'เปิด' AND j.deadline >= CURDATE()
                ORDER BY " . $sortBy . " " . $sortOrder; // เพิ่ม ORDER BY แบบไดนามิก
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>