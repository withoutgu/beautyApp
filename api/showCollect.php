<?php
//    include "http://1.beauty.applinzi.com/api/connect.php";
    header('Access-Control-Allow-Origin:*');
    $servername = "w.rdc.sae.sina.com.cn";
    $user = "0mkknmlwon";
    $pass = "w1kmhx4lwh2xwjikiljl1m4kz2w55jwy3j1mi35j";
    $dbname = 'app_beauty';
    $prot = 3306;

    // 创建连接
    $conn = new mysqli($servername, $user, $pass, $dbname);

    $username = isset($_POST['username'])?$_POST['username']:'rogery';
    // 查询数据库,获取当前用户的收藏数组
    $sql = 'select * from userCollect where username="'.$username.'"';
    // 查询数据库获取数据
    $result = mysqli_query($conn,$sql);
    //使用查询结果集
    $row = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($row);
?>