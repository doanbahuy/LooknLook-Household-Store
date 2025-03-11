<?php
require_once __DIR__ . '/../../../database/db.php';

// Fetch first 3 products
$sql = "SELECT * FROM products LIMIT 6";
$result = mysqli_query($conn, $sql);
?>
<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Danh sách sản phẩm</h2>
    <div class="row">
        <?php while($product = mysqli_fetch_assoc($result)): ?>
       <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex align-items-center p-3  rounded-3 border shadow-sm product-item h-100">
                <img src="<?php echo $product['image']; ?>" class="product-img" alt="<?php echo $product['name']; ?>">
                <div class="ms-3">
                    <h5 class="product-title"><?php echo $product['name']; ?></h5>
                    <p class="product-price">Giá: <?php echo number_format($product['price']); ?> VNĐ</p>
                    <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                        Thêm vào giỏ
                    </button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    
    <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="200">
        <a href="products.php" class="btn btn-primary">Xem tất cả sản phẩm</a>
    </div>
</div>

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
