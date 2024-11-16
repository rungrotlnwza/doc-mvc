<?php
// index.php

include 'config/config.php';

// ดึง URI ที่ผู้ใช้เข้าถึง
$requestUri = $_SERVER['REQUEST_URI'];

// กำหนดเส้นทางพื้นฐาน
$basePath = '/'; // ใช้ / เป็น base path

// ตัดส่วนที่ไม่จำเป็นออกจาก URI
$requestUri = str_replace($basePath, '', $requestUri);
$requestUri = trim($requestUri, '/'); // ลบ / ออกจากต้นและปลาย

// ตรวจสอบ route และโหลด routing ที่เหมาะสม
if (strpos($requestUri, 'api/') === 0) {
    include 'route/Route_API.php'; // โหลด Route_API หากเป็น API route
} else {
    include 'route/Route_Page.php'; // โหลด Route_Page สำหรับหน้าเว็บ
};
?>
