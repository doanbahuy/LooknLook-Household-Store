<?php
session_start();
require_once '../app/config/config.php';
require_once '../database/db.php';

include_once APP_PATH . '/views/blocks/header.php';
?>
<div class="container my-5">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['cart'])): ?>
                <tr>
                    <td colspan="5" class="text-center">Giỏ hàng trống</td>
                </tr>
                <?php else: ?>
                <?php foreach($_SESSION['cart'] as $product_id => $item): ?>
                    <tr class="cart-item" data-price="<?php echo $item['price']; ?>">
                        <td>
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" style="width: 50px">
                            <?php echo $item['name']; ?>
                        </td>
                        <td><?php echo number_format($item['price']); ?> VNĐ</td>
                        <td>
                            <input type="number" min="1" value="<?php echo $item['quantity']; ?>" 
                                class="form-control w-75" data-product-id="<?php echo $product_id; ?>">
                        </td>
                        <td><?php echo number_format($item['price'] * $item['quantity']); ?> VNĐ</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-item" data-product-id="<?php echo $product_id; ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td><strong id="cart-total">
                        <?php
                        $total = 0;
                        if (!empty($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $item) {
                                $total += $item['price'] * $item['quantity'];
                            }
                        }
                        echo number_format($total);
                        ?> VNĐ
</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
        </a>
        <a href="checkout.php" class="btn btn-primary <?php echo empty($_SESSION['cart']) ? 'disabled' : ''; ?>">
            Thanh toán <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
<?php include_once APP_PATH . '/views/blocks/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.remove-item').click(function() {
        const productId = $(this).data('product-id');
        const row = $(this).closest('tr');
        
        $.ajax({
            url: '../app/controllers/remove-from-cart.php',
            type: 'POST',
            data: { product_id: productId },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    // Remove row from table
                    row.remove();
                    
                    // If cart is empty, show empty message
                    if ($('tbody tr').length === 0) {
                        $('tbody').html('<tr><td colspan="5" class="text-center">Giỏ hàng trống</td></tr>');
                        $('.btn-primary').addClass('disabled');
                    }
                    
                    // Recalculate total
                    let total = 0;
                    $('.cart-item').each(function() {
                        const price = parseInt($(this).data('price'));
                        const quantity = parseInt($(this).find('input[type="number"]').val());
                        total += price * quantity;
                    });
                    $('#cart-total').text(total.toLocaleString('vi-VN') + ' VNĐ');
                } else {
                    alert(result.message);
                }
            }
        });
    });
});
</script>
</body>
</html>