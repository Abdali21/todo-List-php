<?php
 require_once 'includes/database.php';
 if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sqlState = $pdo-> prepare("DELETE FROM items WHERE id = ?");
    $result = $sqlState -> execute([$id]);
    header('location:index.php');
 }
?>