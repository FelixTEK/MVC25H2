<?php
require_once 'config/Database.php';
require_once 'models/Job.php';
require_once 'models/Application.php';

class JobController {
    public function listJobs() {
        $database = new Database();
        $db = $database->getConnection();
        $job = new Job($db);

        // ========== เพิ่ม 1 บรรทัดนี้เข้าไป ==========
        // สั่งให้ระบบทำความสะอาดข้อมูลก่อนดึงไปแสดงผลเสมอ
        $job->updateExpiredJobsStatus();
        // ========================================

        // รับค่า sort จาก URL, ถ้าไม่มีใช้ค่า default
        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'deadline';

        // เรียกใช้ฟังก์ชันที่แก้ไขแล้ว
        $stmt = $job->getOpenJobs($sortBy);

        require_once 'views/jobs_list.php';
    }

    public function applyForJob($job_id, $candidate_id) {
        $database = new Database();
        $db = $database->getConnection();
        
        $application = new Application($db);
        $result = $application->create($job_id, $candidate_id);

        // ตรวจสอบว่าผลลัพธ์ที่ได้เป็น array (สมัครสำเร็จ) หรือไม่
        if (is_array($result)) {
            // ดึงค่าจาก array มาสร้างข้อความ
            $jobTitle = htmlspecialchars($result['title']);
            $companyName = htmlspecialchars($result['company_name']);
            $dateTime = date('d/m/Y เวลา H:i น.', strtotime($result['application_date']));

            // สร้างข้อความที่เป็นทางการ
            $message = "การสมัครงานเสร็จสมบูรณ์: ท่านได้สมัครงานตำแหน่ง '{$jobTitle}' ที่บริษัท {$companyName} เมื่อ {$dateTime}";

            // เก็บข้อความลง Session เพื่อให้ View นำไปแสดงผล
            $_SESSION['message'] = $message;
            $_SESSION['message_type'] = "success"; // "success" คือ class ใน CSS สำหรับสีเขียว
        } else {
            // ถ้าผลลัพธ์ไม่ใช่ array แปลว่าเป็น Error
            $_SESSION['message'] = $result;
            $_SESSION['message_type'] = "error"; // "error" คือ class สำหรับสีแดง
        }

        // ส่งผู้ใช้กลับไปที่หน้าแรก
        header("Location: index.php"); // คอมเมนต์บรรทัดนี้ไว้ชั่วคราว
        exit(); // คอมเมนต์บรรทัดนี้ไว้ชั่วคราว

        // เพิ่มบรรทัดนี้เพื่อ Debug
        //die("DEBUG: ข้อความที่จะแสดงคือ -> " . $_SESSION['message']);
    }
}
?>