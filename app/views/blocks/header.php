<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Đồ Gia Dụng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link rel="stylesheet" href="/DATN/public/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            AOS.init({
                duration: 1000, // Thời gian hiệu ứng (ms)
                once: true // Hiệu ứng chỉ chạy một lần
            });
        });
    </script>
</head>
<body>
<header class="header bg-light">
    <div class="container">
        <div class=" d-flex align-items-center justify-content-between pt-2">
            <div class="logo">
                <a href="/DATN/public/index.php">
                    <img src="/DATN/public/assets/img/logo.svg" alt="Đồ Gia Dụng">
                </a>
            </div>
            <form class="row g-3 align-items-center">
                <div class="col-auto">
                    <input type="text" class="form-control" id="" placeholder="Tìm kiếm sản phẩm">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
            <div class="">
                <a href="../../DATN/public/cart.php" class="btn btn-primary">
                    <i class="bi bi-cart"></i>
                </a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="http://localhost/DATN/profile.php" class="btn btn-primary"><i class="bi bi-person"></i></a>
                    <a href="../app/controllers/auth/logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i></a>
                <?php else: ?>
                    <a href="http://localhost/DATN/login.php" class="btn btn-primary">Đăng Nhập</a>
                <?php endif; ?>
            </div>
        </div>
        
     <nav class="navigation flex-grow-1 ">
        <ul class="d-flex justify-content-between">   
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/index.php">Trang Chủ</a></li>
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/products.php">Sản Phẩm</a></li>
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/products.php">Bán chạy</a></li>
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/products.php">Cửa hàng</a></li>
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/products.php">Khuyến mãi</a></li>
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/about.php">Giới Thiệu</a></li>
            <li ><a class="text-decoration-none  text-dark fw-semibold" href="/DATN/public/contact.php">Liên Hệ</a></li>
        </ul>
    </nav>
    </div>
</header>
</body>
</html>