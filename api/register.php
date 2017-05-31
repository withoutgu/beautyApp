<?php
    //引入连接数据可的connect.php
//    include "http://1.beauty.applinzi.com/api/connect.php";
    header('Access-Control-Allow-Origin:*');
    $servername = "w.rdc.sae.sina.com.cn";
	$user = "0mkknmlwon";
	$pass = "w1kmhx4lwh2xwjikiljl1m4kz2w55jwy3j1mi35j";
	$dbname = 'app_beauty';
	$prot = 3306;

	// 创建连接
	$conn = new mysqli($servername, $user, $pass, $dbname);

    //获取用户名
    $username = isset($_POST['username'])?$_POST['username']:'taotao';
    //获取密码
    $password = isset($_POST['password'])?$_POST['password']:'taotao';
    //获取头像url
    $headIconUrl = isset($_POST['headIconUrl'])?$_POST['headIconUrl']:'';
    //获取注册时间
    $createTime = isset($_POST['createTime'])?$_POST['createTime']:'123456';

//    // 查询数据库,看输入的用户名再数据可中是否有密码
//    $sql = 'select password from userinfo where username="'.$username.'"';
//    // 查询数据库获取数据
//    $result = $conn->query($sql);
//    //使用查询结果集
//    $row = $result->fetch_all(MYSQLI_ASSOC);
//
//    //如果结果不等于'[]'即用户名不存在,可以注册
//    if(json_encode($row)!=='[]'){
//        echo 'false';
//    }else{
        $req = 'insert into userinfo(username,password,headIconUrl,createTime) values("'.$username.'","'.$password.'","'
        .$headIconUrl.'","'.$createTime.'")';
        mysqli_query($conn,$req);
        $sql = 'select password from userinfo where username="'.$username.'"';
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
//        echo 'true';
        if(json_encode($row)!=='[]'){
            echo 'true';
        };
//    };

    //关闭连接
//	$result->close();
?>