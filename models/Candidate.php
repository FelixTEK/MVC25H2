<?php
class Candidate {
    // การเชื่อมต่อฐานข้อมูลและชื่อตาราง
    private $conn;
    private $table_name = "candidates";

    // คุณสมบัติของ Candidate
    public $candidate_id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $status;

    // Constructor รับการเชื่อมต่อฐานข้อมูล
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * ฟังก์ชันสำหรับตรวจสอบการเข้าสู่ระบบ
     * @param string $password รหัสผ่านที่ผู้ใช้กรอก
     * @return array|false คืนค่าเป็น array ข้อมูลผู้ใช้ถ้าสำเร็จ, คืนค่า false ถ้าไม่สำเร็จ
     */
    public function login($password) {
        // สร้าง query เพื่อค้นหาอีเมล
        $query = "SELECT candidate_id, first_name, email, password 
                  FROM " . $this->table_name . " 
                  WHERE email = :email 
                  LIMIT 1";
        
        // เตรียม statement
        $stmt = $this->conn->prepare($query);

        // ทำความสะอาดข้อมูล
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        // Bind ค่า email
        $stmt->bindParam(':email', $this->email);
        
        // สั่งให้ query ทำงาน
        $stmt->execute();
        
        // ตรวจสอบว่าเจอผู้ใช้หรือไม่
        if ($stmt->rowCount() > 0) {
            // ดึงข้อมูลผู้ใช้
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // **สำคัญ:** ในระบบจริงควรใช้ password_hash() และ password_verify()
            // แต่สำหรับโปรเจกต์นี้ เราจะเปรียบเทียบรหัสผ่านแบบข้อความธรรมดาตามโจทย์
            if ($password === $row['password']) {
                // ถ้ารหัสผ่านตรงกัน, คืนค่าข้อมูลผู้ใช้
                return $row;
            }
        }
        
        // ถ้าไม่เจอผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง
        return false;
    }
}
?>