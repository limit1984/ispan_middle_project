<?php
//清除購物車API
require __DIR__ . '/Connect_DataBase.php';

unset($_SESSION['cart']);
unset($_SESSION['cartTotal']);
unset($_SESSION['cartShop']);

exit;