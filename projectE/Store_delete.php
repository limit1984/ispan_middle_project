<?php 
require __DIR__ . '/Connect_DataBase.php'; 

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM shop WHERE sid={$sid}";

$pdo->query($sql);

$come_from = 'Store_list.php';

if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from}");