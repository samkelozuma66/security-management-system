<?php
	include('includes/config.php');
	//date_default_timezone_set("Africa/Johannesburg");
	//echo date_default_timezone_get();
	$user_id = $_REQUEST['user_id'];

	$allocqation = $conn->getRow("allocqation",["user_id"=>$user_id,"date"=>date("Y-m-d")]);
	if (!isset($allocqation[0])) {
		$date_array = getdate();
		if ($date_array["hours"] < 7 ) {
			$yesteday = date("Y-m-d",strtotime("-1 day"));
			//echo ($yesteday)		;	// code...
			$allocqation = $conn->getRow("allocqation",["user_id" => $auser[0]['id'] , "date" => $yesteday]);
			if (isset($allocqation[0])) {
				//shift_id
				$shift = $conn->getRow("shift",["id"=>$allocqation[0]["shift_id"]]);

				if (isset($shift[0])) {
					if ($shift[0]["shift_type"] == "day") {
						$allocqation = [];
					}
				}
			}
		}

	}
	if (isset($allocqation[0]))
	{

		$user_checkpoint = $conn->getRow("user_checkpoint",["allocqation_id"=>$allocqation[0]["id"]]);
		if (isset($user_checkpoint[0])) 
		{
			$data = $user_checkpoint[0]["data"];
			$sts_rp = str_replace("'","\"",$data);
			$dta = json_decode($sts_rp,true);

			echo json_encode($dta);

		}
	}


?>