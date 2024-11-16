<?php
// Route_Page.php

// กำหนด page ตาม URI
$page = empty($requestUri) ? '/' : $requestUri; // หากไม่มีการระบุหน้า ให้กำหนดเป็น 'home'

// กำหนด path สำหรับ views
$viewPath = 'view/' . $page . '.html'; // สร้าง path สำหรับไฟล์ที่ต้องการโหลด

// ตรวจสอบว่ามีไฟล์อยู่จริงหรือไม่
if (file_exists($viewPath)) {
    include $viewPath; // ถ้ามีให้โหลดไฟล์ที่ตรงกัน
} else {
    include 'view/404.html'; // ถ้าไม่มีให้โหลดหน้า 404
}
?>
