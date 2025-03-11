<?php
session_start();
require_once '../../../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $sql = "UPDATE users SET fullname = ?, phone = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $fullname, $phone, $address, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['user']['fullname'] = $fullname;
        $_SESSION['success'] = 'Cập nhật thông tin thành công!';
    } else {
        $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại!';
    }
    
    header('Location: /DATN/profile.php');
    exit();
}
