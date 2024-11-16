<?php
// Route_API.php

// ตรวจสอบว่าเป็นการดึงไฟล์ Static (HTML, JS, CSS) หรือไม่
if (isset($_GET['route'])) {
    $route = $_GET['route'];

    // ตรวจสอบว่าเป็นไฟล์ HTML หรือ JS
    if (strpos($route, '.html') !== false || strpos($route, '.js') !== false) {
        $filePath = 'static/' . $route;

        // ตรวจสอบว่าไฟล์ Static มีอยู่หรือไม่
        if (file_exists($filePath)) {
            // ตั้งค่า Content-Type ตามประเภทไฟล์
            if (strpos($route, '.js') !== false) {
                header('Content-Type: application/javascript');
            } elseif (strpos($route, '.html') !== false) {
                header('Content-Type: text/html');
            }

            readfile($filePath); // อ่านไฟล์และส่งไปที่เบราว์เซอร์
            exit;
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Static file not found!";
        }
    }

    // หากไม่ใช่ Static File ให้พิจารณาว่าเป็น API
    $apiFilePath = 'api/' . $route . '.php';

    if (file_exists($apiFilePath)) {
        include $apiFilePath; // หากพบไฟล์ API ให้โหลด
    } else {
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['message' => 'API not found']);
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo json_encode(['message' => 'Missing route parameter']);
}
?>