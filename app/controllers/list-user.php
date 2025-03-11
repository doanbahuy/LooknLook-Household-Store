<?php
include 'db.php';
$stmt = $pdo->query("SELECT * FROM users");

echo "<h2>Danh sách người dùng</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Tên</th><th>Email</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td></tr>";
}
echo "</table>";
?>
