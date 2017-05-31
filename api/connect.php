<?php
	$servername = "w.rdc.sae.sina.com.cn";
	$username = "0mkknmlwon";
	$password = "w1kmhx4lwh2xwjikiljl1m4kz2w55jwy3j1mi35j";
	$dbname = 'app_beauty';
	$prot = 3306;

	// 创建连接
	$conn = new mysqli($servername, $username, $password, $dbname);

//	$conn = mysql_connect($servername.':'.$prot,$servername,$password);

//	 检测连接
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	}
//    if ($conn) {
//        mysql_select_db($dbname, $conn);
//    　　echo 'ok';
//    }else{
//        echo 'error';
//    }

?>