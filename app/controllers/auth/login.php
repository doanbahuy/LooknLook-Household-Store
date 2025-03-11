<?php
session_start();
require_once '../../../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
        header('Location: http://localhost/DATN/login.php');
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'fullname' => $user['fullname'],
                'role' => $user['role']
            ];
            
            if ($user['role'] === 'admin') {
                header('Location: ../../views/admin/dashboard.php');
            } else {
                header('Location: /DATN/public/index.php');
            }
            exit();
        }
    }
    
    $_SESSION['error'] = 'Email hoặc mật khẩu không chính xác';
    header('Location: http://localhost/DATN/login.php');
    exit();
}
