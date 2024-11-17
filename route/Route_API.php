<?php
// Route_API.php

// ตรวจสอบว่ามีการกำหนด route หรือไม่
if (isset($_GET['route'])) {
    $route = $_GET['route']; // เก็บ route จากพารามิเตอร์
    $apiFilePath = 'api/' . $route . '.php'; // กำหนด path สำหรับไฟล์ API

    // ตรวจสอบว่ามีไฟล์ API อยู่จริงหรือไม่
    if (file_exists($apiFilePath)) {
        include $apiFilePath; // ถ้ามีให้โหลดไฟล์ API
    } else {
        // ถ้าไม่มีให้แสดงข้อความว่าไม่พบ API
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['message' => 'ไม่พบ API']);
    }
} else {
    // หากไม่มีการกำหนด route
    header("HTTP/1.0 400 Bad Request");
    echo json_encode(['message' => 'กรุณากำหนด API route']);
}
?>
