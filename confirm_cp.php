<?php 
	include('includes/config.php');
	
	$user_id = $_REQUEST['user_id'];
	$cd_code = $_REQUEST['cp_code'];

	function searchField($row) 
	{
		if ($row["cp_code"] == $cd_code ) {
			return 1;
		}
	}

	$allocqation = $conn->getRow("allocqation",["user_id"=>$user_id,"date"=>date("Y-m-d")]);
	if (isset($allocqation[0])) 
	{
		$user_checkpoint = $conn->getRow("user_checkpoint",["allocqation_id"=>$allocqation[0]["id"]]);
		if (isset($user_checkpoint[0])) 
		{
			$data = $user_checkpoint[0]["data"];
			$sts_rp = str_replace("'","\"",$data);
			$dta = json_decode($sts_rp,true);
			$current_cp = $allocqation[0]["current_cp"];

			$cp = array_filter($dta,function($row) use ($cd_code){
				if ($row["cp_code"] == $cd_code ) 
				{
					return 1;
				}
			});
			
			foreach($cp as $x => $val)
			{
				$lastcheck =$val["lastcheck"];
				$val["data"][$lastcheck] = "yes";
				$val["lastcheck"] = $lastcheck + 1;
				$dta[$x] =$val;
			}
			$done = json_encode($dta);
			$user_checkpoint[0]["data"] = $done;

			
			$coll = $conn->updateData("user_checkpoint",$user_checkpoint[0],["id"=>$user_checkpoint[0]["id"]]);
			if ($coll) {
				$current_cp = $current_cp + 1;
				$coll = $conn->updateData("allocqation",["current_cp" => $current_cp ],["id"=>$allocqation[0]["id"]]);
				echo "CONFIRMED";
			}
			
		}

	}
	//var_dump($user_checkpoint[0]);
?>