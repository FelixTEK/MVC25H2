<?php

require_once 'config/Database.php';
require_once 'models/Candidate.php';

class AuthController {

    public function login() {
        $database = new Database();
        $db = $database->getConnection();
        
        $candidate = new Candidate($db);
        
        // รับข้อมูลจากฟอร์ม (method="POST")
        $candidate->email = $_POST['email'];
        $password = $_POST['password'];

        $login_result = $candidate->login($password);

        if ($login_result) {
            // ถ้า login สำเร็จ, สร้าง session
            session_start();
            $_SESSION['candidate_id'] = $login_result['candidate_id'];
            $_SESSION['first_name'] = $login_result['first_name'];
            
            // ส่งกลับไปหน้าแรก
            header("Location: index.php");
            exit();
        } else {
            // ถ้า login ไม่สำเร็จ, ส่งกลับไปหน้า login พร้อม error
            header("Location: index.php?action=login&error=อีเมลหรือรหัสผ่านไม่ถูกต้อง");
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>