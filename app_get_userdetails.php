<?php
	include('includes/config.php');
	$user  = $conn->getRow('users',["email"=> $_REQUEST['username']]);
	echo json_encode($user) ;

?>