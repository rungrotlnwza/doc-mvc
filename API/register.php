<?php
// การตั้งค่าการเชื่อมต่อฐานข้อมูล
$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'my_database';

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit;
}

// อ่านข้อมูล JSON ที่ส่งมาจาก Frontend
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจาก payload
    $name = isset($data['name']) ? trim($data['name']) : '';
    $username = isset($data['username']) ? trim($data['username']) : '';
    $password = isset($data['password']) ? $data['password'] : '';

    // ตรวจสอบว่าฟิลด์ไม่ว่างเปล่า
    if (empty($name) || empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่ในฐานข้อมูลหรือไม่
    $check_query = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(409); // Conflict
        echo json_encode(['success' => false, 'message' => 'Username is already taken.']);
        exit;
    }

    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // เพิ่มผู้ใช้ใหม่ในฐานข้อมูล
    $insert_query = "INSERT INTO users (name, username, password) VALUES (?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "sss", $name, $username, $hashed_password);

    if (mysqli_stmt_execute($insert_stmt)) {
        http_response_code(201); // Created
        echo json_encode(['success' => true, 'message' => 'Registration successful.']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['success' => false, 'message' => 'Registration failed: ' . mysqli_error($conn)]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
