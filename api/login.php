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

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

    //    echo $username.','.$password.',';

    	// 查询数据
        // 以传入的username作为条件,搜索密码
    	$sql = 'select password from userinfo where username="'.$username.'"';
    	$sqlt = 'select createTime from userinfo where username="'.$username.'"';

    	// 查询数据库获取数据
    	$result = mysqli_query($conn,$sql);
        $resultt = mysqli_query($conn,$sqlt);
    	//使用查询结果集
    	$row = $result->fetch_row();
        $rowt = $resultt->fetch_row();

        if(json_encode($row[0]) == '"'.$password.'"'){
            echo json_encode($rowt[0]);
        }else{
            echo 'false';
        }

        $result->close();
    //    echo json_encode($row[0]);
    //    echo '"'.$password.'"';
?>