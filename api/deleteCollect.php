<?php
//    include 'http://1.beauty.applinzi.com/api/connect.php';
    header('Access-Control-Allow-Origin:*');
    $servername = "w.rdc.sae.sina.com.cn";
    $user = "0mkknmlwon";
    $pass = "w1kmhx4lwh2xwjikiljl1m4kz2w55jwy3j1mi35j";
    $dbname = 'app_beauty';
    $prot = 3306;

    // 创建连接
    $conn = new mysqli($servername, $user, $pass, $dbname);

    $title = isset($_POST["title"])?$_POST["title"]:'';
    $username = isset($_POST["username"])?$_POST["username"]:'';

    echo $title;
    echo $username;

    $sql = 'delete from usercollect where title="'.$title.'" and username="'.$username.'"';

    $result = mysqli_query($conn,$sql);

?>