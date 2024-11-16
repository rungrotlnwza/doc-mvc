<?php
// config/config.php


// ฟังก์ชันเชื่อมต่อฐานข้อมูลแบบ mysqli
function db_connect() {
    $conn = mysqli_connect('localhost', 'root', '', 'database');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>