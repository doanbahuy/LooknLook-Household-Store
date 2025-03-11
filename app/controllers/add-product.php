<?php
require_once '../config/config.php';
require_once '../../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    
    // Xử lý upload hình ảnh
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $targetDir = "../../public/uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $imageFileType;
        $targetFile = $targetDir . $newFileName;
        
        // Upload file
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            $imagePath = 'uploads/' . $newFileName;
            
            // Thêm sản phẩm vào database
            $sql = "INSERT INTO products (name, price, image) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sds", $productName, $productPrice, $imagePath);
            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../views/admin/products.php");
                exit();
            } else {
                $error = "Lỗi: " . mysqli_error($conn);
            }
        } else {
            $error = "Lỗi khi upload file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm sản phẩm mới</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Giá</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="product_image" name="product_image" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="../views/admin/products.php" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
