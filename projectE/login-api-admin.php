<?php
require __DIR__ . 'Connect_DataBase.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

if(empty($_POST['email']) or empty($_POST['password'])){
    $output['error'] = '參數不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; // 結束程式
}

// 用帳號找資料
$sql = "SELECT * FROM admins WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['email']]);
$row = $stmt->fetch();

if(empty($row)){
    $output['error'] = '帳號或密碼錯誤'; // 帳號錯誤
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; // 結束程式
}

// 驗證密碼
if( password_verify($_POST['password'], $row['password_hash']) ) {
    $output['success'] = true;
    $_SESSION['admin'] = [
        'sid' => $row['sid'],
        'email' => $row['email'],
    ];
} else {
    $output['error'] = '帳號或密碼錯誤'; // 帳號錯誤
    $output['code'] = 421;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);