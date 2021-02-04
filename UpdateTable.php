<?php
    require_once 'connection.php';
    require_once 'CProducts.php';

    $cproducts = new CProducts();
    $link = $cproducts->connectionDB($host, $user, $password, $database);
    $cproducts->checkConnectDB($link, $database);
    $query = $_POST['querytext'];
    $cproducts->resultQuery($link, $query);
    mysqli_close($link);
?>