<!DOCTYPE html>
<html>
<head>
    <title>Job Fair - ตำแหน่งงานที่เปิดรับ</title>
    <style>
        /* CSS ทั่วไป */
        body { font-family: sans-serif; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        button { cursor: pointer; padding: 8px 15px; border: none; border-radius: 4px; background-color: #007bff; color: white; }
        button:hover { background-color: #0056b3; }

        /* CSS สำหรับส่วน Navigation ของผู้ใช้ */
        .user-nav { text-align: right; padding: 10px; background-color: #f2f2f2; margin-bottom: 20px; border-bottom: 1px solid #ddd; }

        /* ========== CSS สำหรับข้อความแจ้งเตือน (Flash Message) ========== */
        .message { padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid transparent; }
        .message.success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .message.error { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        /* ============================================================= */
    </style>
</head>
<body>

    <div class="user-nav">
        <?php if (isset($_SESSION['candidate_id'])) : ?>
            <span>สวัสดี, <strong><?php echo htmlspecialchars($_SESSION['first_name']); ?></strong>!</span>
            <a href="index.php?action=logout" style="margin-left: 15px;">ออกจากระบบ</a>
        <?php else : ?>
            <a href="index.php?action=login">เข้าสู่ระบบ</a>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message <?php echo $_SESSION['message_type']; ?>">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            ?>
        </div>
    <?php endif; ?>
    <h1>ตำแหน่งงานที่เปิดรับสมัคร</h1>

    <div style="margin-bottom: 20px;">
        <strong>เรียงลำดับตาม:</strong>
        <a href="index.php?sort=title">ชื่อตำแหน่งงาน</a> |
        <a href="index.php?sort=company_name">ชื่อบริษัท</a> |
        <a href="index.php?sort=deadline">วันปิดรับสมัคร</a>
    </div>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
        extract($row);
    ?>
        <div>
            <h2><?php echo htmlspecialchars($title); ?> (<?php echo htmlspecialchars($type); ?>)</h2>
            <p><strong>บริษัท:</strong> <?php echo htmlspecialchars($company_name); ?></p>
            <p><?php echo htmlspecialchars($description); ?></p>
            <p><strong>ปิดรับสมัคร:</strong> <?php echo $deadline; ?></p>
            
            <form action="index.php?action=apply" method="POST" style="display: inline;">
                <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                <button type="submit">สมัครตำแหน่งนี้</button>
            </form>
            <hr>
        </div>
    <?php endwhile; ?>

</body>
</html>