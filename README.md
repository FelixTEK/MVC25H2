## เทคโนโลยีที่ใช้ (Tech Stack)

  * **Backend:** PHP
  * **Database:** MySQL (MariaDB)
  * **Web Server:** Apache (จำลองด้วยโปรแกรม XAMPP)
  * **Frontend:** HTML, CSS

## ครงสร้างโปรเจกต์ (Project Structure)

```
mvc/
├── config/
│   └── Database.php      # คลาสสำหรับเชื่อมต่อฐานข้อมูล
├── controllers/
│   ├── AuthController.php  # จัดการ Logic การ Login/Logout
│   └── JobController.php   # จัดการ Logic เกี่ยวกับตำแหน่งงานและการสมัคร
├── models/
│   ├── Application.php     # Model จัดการตาราง 'applications' และ Business Logic
│   ├── Candidate.php       # Model จัดการตาราง 'candidates'
│   └── Job.php             # Model จัดการตาราง 'jobs' และอัปเดตสถานะ
├── views/
│   ├── jobs_list.php       # View แสดงรายการงาน (หน้าหลัก)
│   └── login.php           # View แสดงฟอร์ม Login
├── .gitignore              # ไฟล์สำหรับบอก Git ว่าไม่ต้องสนใจไฟล์ใดบ้าง (ไม่ต้อง add/commit มาด้วย)
├── database.sql            # สคริปต์สำหรับสร้างและลงข้อมูลในฐานข้อมูล
├── README.md               # ไฟล์ที่คุณกำลังอ่านอยู่
└── index.php               # Front Controller หลักสำหรับรับทุก Request
```