<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    echo "Xóa thành công!";
}
?>
<a href="list_users.php">Quay lại danh sách</a>
