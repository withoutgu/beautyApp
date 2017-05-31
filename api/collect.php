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

    $username = isset($_POST['username'])?$_POST['username']:'';
    $url = isset($_POST['url'])?$_POST['url']:'';
    $title = isset($_POST['title'])?$_POST['title']:'';

    // 查询数据库,看输入的用户名再数据可中是否有对应标题
    $sql = 'select title from usercollect where username="'.$username.'"';
    // 查询数据库获取数据
    $result = mysqli_query($conn,$sql);
    //使用查询结果集
    $row = $result->fetch_all();
//    echo json_encode($row);


    $len = count($row);

//    echo $len;
    for($i=0;$i<$len;$i++){
//        echo json_encode($row[$i][0])."</br>";
        if($title  == $row[$i][0]){
            echo 'false';
            exit;
        }
    };

        echo $title;
        $req = 'insert into usercollect(username,url,title) values("'.$username.'","'.$url.'","'.$title.'")';
        mysqli_query($conn,$req);

    //            break;
//    echo json_encode($title);
?>