<?php
require_once 'config/Database.php';
require_once 'models/Job.php';
require_once 'models/Application.php';

class JobController {
    public function listJobs() {
        $database = new Database();
        $db = $database->getConnection();

        $job = new Job($db);
        $stmt = $job->getOpenJobs();
        
        // ส่งข้อมูล $stmt ไปให้ View
        require_once 'views/jobs_list.php';
    }

    public function applyForJob($job_id, $candidate_id) {
        $database = new Database();
        $db = $database->getConnection();
        
        $application = new Application($db);
        $result = $application->create($job_id, $candidate_id);

        // ================== เพิ่มโค้ดบรรทัดนี้เพื่อ DEBUG ==================
        var_dump($result); 
        die(" --- End of Debug --- ");
        // ===============================================================


        if ($result === true) {
            // Business Rule: เมื่อสมัครเสร็จ ต้องกลับไปหน้าตำแหน่งงาน
            echo "<script>alert('สมัครงานสำเร็จ!'); window.location.href='index.php';</script>";
        } else {
            // แสดงข้อผิดพลาด
            echo "<script>alert('{$result}'); window.history.back();</script>";
        }
    }
}
?>