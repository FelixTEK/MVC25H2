<?php
session_start(); // เริ่ม session สำหรับระบบ login

// ดูว่ามีการร้องขอ action อะไรมา
$action = isset($_GET['action']) ? $_GET['action'] : 'listJobs';

// เรียก Controller ที่เกี่ยวข้อง
require_once 'controllers/JobController.php';
$controller = new JobController();

switch ($action) {
    case 'apply':
        // ================== เพิ่มโค้ดบรรทัดนี้เพื่อ DEBUG ==================
        die("สำเร็จ! Router วิ่งเข้ามาใน case 'apply' แล้ว");
        // ===============================================================

        // ต้อง login ก่อนถึงจะสมัครได้
        if (!isset($_SESSION['candidate_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        $job_id = isset($_GET['job_id']) ? $_GET['job_id'] : die('ERROR: Job ID not found.');
        $controller->applyForJob($job_id, $_SESSION['candidate_id']);
        break;

    case 'login': // สำหรับแสดงหน้าฟอร์ม login
        require_once 'views/login.php';
        break;

    case 'processLogin': // สำหรับประมวลผลข้อมูลจากฟอร์ม
        // (เราจะสร้าง Controller สำหรับจัดการส่วนนี้)
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        $authController->login();
        break;

    case 'logout':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        $authController->logout();
        break;
    
    default:
        $controller->listJobs();
        break;
}
?>