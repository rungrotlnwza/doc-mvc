<?php
$route = isset($_GET['route']) ? $_GET['route'] : 'default';

header('Content-Type: application/json');

if ($route === 'register') {
    echo json_encode(['success' => true, 'message' => 'API register route is working.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid route: ' . $route]);
}
?>
