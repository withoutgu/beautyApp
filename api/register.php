<?php
    //引入连接数据可的connect.php
    include "connect.php";
    //获取用户名
    $username = isset($_POST['username'])?$_POST['username']:'';
    //获取密码
    $password = isset($_POST['password'])?$_POST['password']:'';
    //获取头像url
    $headIconUrl = isset($_POST['headIconUrl'])?$_POST['headIconUrl']:'';
    //获取注册时间
    $createTime = isset($_POST['createTime'])?$_POST['createTime']:'';

    // 查询数据库,看输入的用户名再数据可中是否有密码
    $sql = 'select password from userinfo where username="'.$username.'"';
    // 查询数据库获取数据
    $result = $conn->query($sql);
    //使用查询结果集
    $row = $result->fetch_all(MYSQLI_ASSOC);

    //如果结果不等于'[]'即用户名不存在,可以注册
    if(json_encode($row)!=='[]'){
        echo 'false';
    }else{
        $req = 'insert into userinfo(username,password,headIconUrl,createTime) values('.$username.','.$password.','
        .$headIconUrl.','.$createTime.')';
        $conn->query($req);
        echo 'true';
    };

    //关闭连接
	$result->close();
?>