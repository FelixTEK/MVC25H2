<?php
session_start(); // เริ่ม session สำหรับระบบ login

// ================== เพิ่มโค้ดส่วนนี้เข้าไป ==================

// สร้างรายการหน้าที่อนุญาตให้เข้าถึงได้โดยไม่ต้อง login
$allowed_actions = ['login', 'processLogin'];

// ดึง action ปัจจุบัน
$current_action = isset($_GET['action']) ? $_GET['action'] : 'listJobs';

// ตรวจสอบ: ถ้ายังไม่ได้ login และ action ที่กำลังจะทำไม่อยู่ในรายการที่อนุญาต
if (!isset($_SESSION['candidate_id']) && !in_array($current_action, $allowed_actions)) {
    // ส่งกลับไปหน้า login ทันที
    header('Location: index.php?action=login');
    exit();
}
// ==========================================================


// ดูว่ามีการร้องขอ action อะไรมา (เปลี่ยนตัวแปรนิดหน่อย)
$action = $current_action;

// เรียก Controller ที่เกี่ยวข้อง
require_once 'controllers/JobController.php';
$controller = new JobController();

switch ($action) {
    case 'apply':
        // เอา die() และ if() ออกได้เลย เพราะยามหน้าประตูจัดการให้แล้ว
        $job_id = isset($_GET['job_id']) ? $_GET['job_id'] : die('ERROR: Job ID not found.');

        // ส่งข้อมูลต่อไปให้ Controller ทำงานตามปกติ
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