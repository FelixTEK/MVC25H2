-- สร้างฐานข้อมูล
CREATE DATABASE mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- เลือกใช้ฐานข้อมูล
USE mvc;

-- 1. ตารางบริษัท (Companies)
CREATE TABLE companies (
    company_id INT(8) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    location VARCHAR(255)
);

-- 2. ตารางผู้สมัคร (Candidates)
CREATE TABLE candidates (
    candidate_id INT(8) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- สำหรับระบบ Login
    status ENUM('กำลังศึกษา', 'จบแล้ว') NOT NULL
);

-- 3. ตารางตำแหน่งงาน (Jobs)
CREATE TABLE jobs (
    job_id INT(8) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    company_id INT(8) UNSIGNED ZEROFILL NOT NULL,
    deadline DATE NOT NULL,
    status ENUM('เปิด', 'ปิด') NOT NULL DEFAULT 'เปิด',
    type ENUM('งานปกติ', 'สหกิจศึกษา') NOT NULL,
    FOREIGN KEY (company_id) REFERENCES companies(company_id)
);

-- 4. ตารางใบสมัคร (Applications) - ตารางที่เพิ่มเข้ามา
CREATE TABLE applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT(8) UNSIGNED ZEROFILL NOT NULL,
    candidate_id INT(8) UNSIGNED ZEROFILL NOT NULL,
    application_date DATETIME NOT NULL,
    FOREIGN KEY (job_id) REFERENCES jobs(job_id),
    FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id)
);