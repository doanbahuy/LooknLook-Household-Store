<?php
require_once __DIR__ . '/../../../database/db.php';

// Fetch top selling products
$sql = "SELECT * FROM products LIMIT 3";
$result = mysqli_query($conn, $sql);
?>
<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Sản phẩm bán chạy</h2>
    <div class="row">
        <?php while($product = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card shadow-sm h-100">
                <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text">Giá: <?php echo number_format($product['price']); ?> VNĐ</p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
