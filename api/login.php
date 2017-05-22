<?php
    include 'connect.php';

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

    //    echo $username.','.$password.',';

    	// 查询数据
        // 以传入的username作为条件,搜索密码
    	$sql = 'select password from userinfo where username="'.$username.'"';

    	// 查询数据库获取数据
    	$result = $conn->query($sql);

    	//使用查询结果集
    	$row = $result->fetch_row();
        //判断传入的密码与数据库中的密码是否一致
        if(json_encode($row[0])===null){
            echo 'false';
        }else{
            if(json_encode($row[0]) == '"'.$password.'"'){
                echo 'true';
            }else{
                echo 'false';
            }
        }
        $result->close();
    //    echo json_encode($row[0]);
    //    echo '"'.$password.'"';
?>