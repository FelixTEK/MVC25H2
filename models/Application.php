<?php
class Application {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ฟังก์ชันสร้างใบสมัคร พร้อมเงื่อนไข
    public function create($job_id, $candidate_id) {
        // 1. ดึงข้อมูลงาน (ประเภทงาน)
        $job_query = "SELECT type FROM jobs WHERE job_id = :job_id";
        $job_stmt = $this->conn->prepare($job_query);
        $job_stmt->bindParam(':job_id', $job_id);
        $job_stmt->execute();
        $job = $job_stmt->fetch(PDO::FETCH_ASSOC);

        // 2. ดึงข้อมูลผู้สมัคร (สถานะ)
        $candidate_query = "SELECT status FROM candidates WHERE candidate_id = :candidate_id";
        $cand_stmt = $this->conn->prepare($candidate_query);
        $cand_stmt->bindParam(':candidate_id', $candidate_id);
        $cand_stmt->execute();
        $candidate = $cand_stmt->fetch(PDO::FETCH_ASSOC);

        // 3. ตรวจสอบ Business Rules ตามโจทย์
        if ($job['type'] == 'สหกิจศึกษา' && $candidate['status'] != 'กำลังศึกษา') {
            return "Error: ตำแหน่งสหกิจศึกษาสำหรับผู้ที่กำลังศึกษาเท่านั้น";
        }

        if ($job['type'] == 'งานปกติ' && $candidate['status'] != 'จบแล้ว') {
            return "Error: ตำแหน่งงานปกติสำหรับผู้ที่จบการศึกษาแล้วเท่านั้น";
        }

        // 4. ถ้าผ่านเงื่อนไข ให้บันทึกใบสมัคร
        $insert_query = "INSERT INTO applications (job_id, candidate_id, application_date) VALUES (:job_id, :candidate_id, NOW())";
        $stmt = $this->conn->prepare($insert_query);

        // bind values
        $stmt->bindParam(':job_id', $job_id);
        $stmt->bindParam(':candidate_id', $candidate_id);

        if ($stmt->execute()) {
            return true;
        }
        return "Error: " . $stmt->errorInfo();
    }
}
?>