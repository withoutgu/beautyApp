<?php
    //引入连接数据可的connect.php
    include "http://1.beauty.applinzi.com/api/connect.php";
    //获取用户名
    $username = isset($_POST['username'])?$_POST['username']:'';

    // 查询数据
    // 以传入的username作为条件,搜索头像和注册时间
    $sql = 'select headIconUrl from userinfo where username="'.$username.'"';

    // 查询数据库获取数据
    $result = $conn->query($sql);

    //使用查询结果集
    $row = $result->fetch_row();

    //返回信息到前端
    echo json_encode($row[0])
?>