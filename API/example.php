<?php
// api/example.php

header('Content-Type: application/json');

// ตัวอย่างการตอบกลับ API
$response = [
    'status' => 'success',
    'data' => [
        'message' => 'Hello from the example API!'
    ]
];

echo json_encode($response);
?>
