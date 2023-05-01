<?php 
// require './admin-required.php';  //之後再處理
require __DIR__.'./Connect_DataBase.php'; 




$author = isset($_GET['author']) ? intval($_GET['author']) : 0;

$sql = "DELETE FROM chat WHERE chat=$author";

$pdo->query($sql);

$come_from = 'Chat_index.php';
//轉跳頁面用
if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from}");
