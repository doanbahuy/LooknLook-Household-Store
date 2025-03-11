<?php
session_start();
define('ROOT_PATH', dirname(__DIR__) . '/');
define('VIEW_PATH', ROOT_PATH . 'app/views/blocks/');
require_once '../database/db.php';

// Fetch all products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<?php include(VIEW_PATH . 'header.php'); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Tất cả sản phẩm</h2>
    
    <div class="row">
        <?php while($product = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 product-item">
                <img src="<?php echo $product['image']; ?>" class="card-img-top product-img w-100" alt="<?php echo $product['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title product-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text product-price">Giá: <?php echo number_format($product['price']); ?> VNĐ</p>
                    <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                        Thêm vào giỏ
                    </button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include(VIEW_PATH . 'footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart').click(function() {
        const productId = $(this).data('product-id');
        $.ajax({
            url: '../app/controllers/add-to-cart.php',
            type: 'POST',
            data: { product_id: productId },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    alert('Đã thêm sản phẩm vào giỏ hàng!');
                } else {
                    alert(result.message);
                }
            }
        });
    });
});
</script>
