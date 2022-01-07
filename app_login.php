<?php
	include('includes/config.php');
	$status='1';
	$email=$_REQUEST['username'];
	$password=md5($_REQUEST['password']);
	$sql ="SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> bindParam(':status', $status, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0)
	{
		$_SESSION['alogin']=$_REQUEST['username'];
		$notitype='Logged in';
		$reciver='Admin';
		$sender=$email;

		$sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
		$querynoti = $dbh->prepare($sqlnoti);
		$querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
		$querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
		$querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
		$querynoti-> execute(); 
		$user  = $conn->getRow('users',["email"=> $_REQUEST['username']]);
		echo json_encode($user) ;
	}
	else
	{
		echo "[]";
	}
?>