<?php
session_start();
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate input
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
        header('Location: ../../register.php');
        exit();
    }
    
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Mật khẩu xác nhận không khớp';
        header('Location: ../../register.php');
        exit();
    }
    
    // Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        $_SESSION['error'] = 'Email đã tồn tại';
        header('Location: ../../register.php');
        exit();
    }
    
    // Hash password and insert new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, 'customer')";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }
    $stmt->bind_param("sss", $fullname, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'Đăng ký thành công';
        header('Location: ../../login.php');
        exit();
    } else {
        $_SESSION['error'] = 'Đã có lỗi xảy ra';
        header('Location: ../../register.php');
        exit();
    }
}
