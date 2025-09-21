<!DOCTYPE html>
<html>
<head>
    <title>Job Fair - ตำแหน่งงานที่เปิดรับ</title>
    <style> /* สามารถเพิ่ม CSS เพื่อความสวยงามได้ */ </style>
</head>
<body>

    <div style="text-align: right; padding: 10px; background-color: #f2f2f2; margin-bottom: 20px;">
        <?php
        // ตรวจสอบว่ามีการ login แล้วหรือยัง
        if (isset($_SESSION['candidate_id'])) : ?>
            
            <span>สวัสดี, <strong><?php echo htmlspecialchars($_SESSION['first_name']); ?></strong>!</span>
            <a href="index.php?action=logout" style="margin-left: 15px;">ออกจากระบบ</a>

        <?php else : ?>

            <a href="index.php?action=login">เข้าสู่ระบบ</a>

        <?php endif; ?>
    </div>
    <h1>ตำแหน่งงานที่เปิดรับสมัคร</h1>

    <?php 
    // วนลูปเพื่อแสดงข้อมูลแต่ละแถว
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
        // extract($row) จะสร้างตัวแปรจาก key ของ array
        // เช่น $row['title'] จะกลายเป็นตัวแปร $title
        extract($row);
    ?>
        <div>
            <h2><?php echo htmlspecialchars($title); ?> (<?php echo htmlspecialchars($type); ?>)</h2>
            
            <p><strong>บริษัท:</strong> <?php echo htmlspecialchars($company_name); ?></p>
            
            <p><?php echo htmlspecialchars($description); ?></p>
            
            <p><strong>ปิดรับสมัคร:</strong> <?php echo $deadline; ?></p>
            
            <a href="index.php?action=apply&job_id=<?php echo $job_id; ?>">
                <button>สมัครตำแหน่งนี้</button>
            </a>
            <hr>
        </div>
    <?php endwhile; ?>

</body>
</html>