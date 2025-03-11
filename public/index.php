<?php
session_start();
define('ROOT_PATH', dirname(__DIR__) . '/');
define('VIEW_PATH', ROOT_PATH . 'app/views/blocks/');

// Nạp file header
include(VIEW_PATH . 'header.php');
?>

<main>
    <?php
        include(VIEW_PATH . 'banner.php');
        include(VIEW_PATH . 'high-light-products.php');
        include(VIEW_PATH . 'products-list.php');
    ?>
</main>

<?php include (VIEW_PATH . 'footer.php'); ?>