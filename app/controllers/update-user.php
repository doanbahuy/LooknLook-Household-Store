<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
    $stmt->execute([$name, $id]);

    echo "Cập nhật thành công!";
}

$id = $_GET['id'] ?? '';
$user = $pdo->query("SELECT * FROM users WHERE id = $id")->fetch();
?>
<form method="post">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="text" name="name" value="<?= $user['name'] ?>" required>
    <button type="submit">Cập nhật</button>
</form>
