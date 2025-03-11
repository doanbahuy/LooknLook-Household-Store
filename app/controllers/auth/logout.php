<?php
session_start();
session_destroy();
header('Location: http://localhost/DATN/login.php');
exit();