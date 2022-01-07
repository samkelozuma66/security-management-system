<?php
session_start();
//date_default_timezone_set("Africa/Johannesburg");
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$auser = $conn->getRow("users",["email" => $_SESSION['alogin']]);
	$dat = date("Y-m-d");
	$current_time = strftime("%H:%M:%S");
	$ct_array = explode(":",$current_time);

	//var_dump(getdate());



	//$shift 
	//echo "dat ".$dat;
	$allocqation = $conn->getRow("allocqation",["user_id" => $auser[0]['id'] , "date" => $dat]);
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
 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Allocation</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>

	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title"><?php echo date("Y-m-d"); ?> Allocation</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Site Allocation</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th>#</th>
												<th>Site Name</th>
												<th>Address</th>
												<th>Note</th>
												<th>Date</th>
										</tr>
									</thead>
									
									<tbody>

<?php $sql = "SELECT * from  allocqation , site  where allocqation.user_id = ".$auser[0]['id']." and allocqation.date = '".$allocqation[0]["date"]."' and site.id = allocqation.site_id ";
//users.id = equipment_allocation.user_id and equipment.id = equipment_allocation.equip_id";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->site_name);?></td>
											<td><?php echo htmlentities($result->site_address);?></td>
											<td><?php echo htmlentities($result->note);?></td>
                                            <td><?php echo htmlentities($result->date);?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
							</div>
						</div>
						<?php 
							if (isset($auser[0])) {
								if($auser[0]['user_type'] == 'manager')
								{
									?>
						<h3 class="page-title">Guard Allocation</h3>
						<div class="panel panel-default">
							<div class="panel-heading">Guards</div>
							<div class="panel-body"> 
								<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb1" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Date</th>
                                                <th>Guards Name</th>
                                                <th>Note</th>
											<th>Action</th>	
										</tr>
									</thead>
									<tbody>
										<?php 
$sql = "SELECT * from  allocqation,users where  site_id =".$allocqation[0]["site_id"]." and allocqation.user_id = users.id and allocqation.user_id <> ".$auser[0]['id']." ORDER BY date DESC"  ;
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	

										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->date);?></td>
                                            <td><?php echo htmlentities($result->name);?></td>
                                            <td><?php echo htmlentities($result->note);?></td>
                                           
											
											<td>
											<a href="edit-user.php?edit=<?php echo $result->id;?>" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
											<a href="userlist.php?del=<?php echo $result->id;?>&name=<?php echo htmlentities($result->email);?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
											<a href="userlist.php?del=<?php echo $result->id;?>&name=<?php echo htmlentities($result->email);?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-suitcase" style="color:green"></i></a>&nbsp;&nbsp;
											</td>
										</tr>

	<?php $cnt=$cnt+1; }} ?>
									</tbody>
								</table>	
							</div>
						</div>
						<h3 class="page-title">Guard Checkpoints</h3>
						<div class="panel panel-default">
							<div class="panel-heading">Guards</div>
							<div class="panel-body"> 
								<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb1" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Guards Name</th>
                                                <th>data</th>
										</tr>
									</thead>
									<tbody>
										<?php 
$sql = "SELECT * from  allocqation,user_checkpoint,users where  site_id =".$allocqation[0]["site_id"]." and user_checkpoint.allocqation_id = allocqation.id and users.id = allocqation.user_id";
$sql1 = "SELECT * from  allocqation,user_checkpoint,users where  site_id =".$allocqation[0]["site_id"]." and user_checkpoint.allocqation_id = allocqation.id and allocqation.user_id = users.id and allocqation.user_id <> ".$auser[0]['id']." ORDER BY date DESC"  ;
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				
	$sts_rp = str_replace("'","\"",$result->data);
	$dta = json_decode($sts_rp,true);
	
	?>	

										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->name);?></td>
                                            <td>
                                            	<table class="display table table-striped table-bordered table-hover">
                                            		<thead>
                                            			<th>CP Code</th>
                                            		</thead>
                                            	<?php 
                                            	foreach($dta as $line)
                                            	{
                                            		//<i class="fa fa-envelope"></i>
                                            	?>
                                            		<tr><td><?php echo $line["cp_code"];?></td>
                                            			<td><?php  if($line["data"][0] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][1] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][2] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][3] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][4] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][5] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][6] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][7] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][8] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][9] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][10] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][11] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            			<td><?php  if($line["data"][12] == 'no'){ echo '<i class="fa fa-times" style="color:red;"></i>'; }else{ echo '<i class="fa fa-check" style="color:green;"></i>'; }?></td>
                                            		</tr>
                                            	<?php 
                                            	}
                                            	?>
                                            	</table>

                                            </td>
                                           
										</tr>

	<?php $cnt=$cnt+1; }} ?>
									</tbody>
								</table>	
							</div>
						</div>
							<?php 

								}
							}
							?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
</body>
</html>
<?php } ?>
