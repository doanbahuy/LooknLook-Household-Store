<?php
session_start();
require_once 'database/db.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Fix the path definitions
define('ROOT_PATH', __DIR__ . '/');
define('VIEW_PATH', ROOT_PATH . 'app/views/blocks/');

$user_id = $_SESSION['user']['id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

    <?php include(VIEW_PATH . 'header.php'); ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img src="assets/img/avatar-default.png" class="rounded-circle mb-3" width="120" alt="Avatar">
                        <h4><?php echo $user['fullname']; ?></h4>
                        <p class="text-muted"><?php echo $user['email']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Thông tin cá nhân</h5>
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                        <?php endif; ?>
                        
                        <form action="app/controllers/auth/update-profile.php" method="POST">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $user['phone'] ?? ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" id="address" name="address" rows="3"><?php echo $user['address'] ?? ''; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(VIEW_PATH . 'footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>