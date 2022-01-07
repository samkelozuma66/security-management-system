<?php
error_reporting(0);
include('./config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['site']))
{
	$site = $conn->getRow("site",["id"=>$_GET['site']]);
}


	
if(isset($_POST['submit']))
  {
  	$guard=$_POST['guard'];
  	$equipment = $_POST['equipment'];
	$note=$_POST['note'];
	$date = date("Y-m-d");
	//equipment


	
	$in = $conn->insData("equipment_allocation",["user_id" => $guard,
								 "equip_id" => $equipment,
								 "date" => $date,
								 "note" => $note]);

	
	$msg="Information Updated Successfully";
	
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
	
	<title>Allocate Equipment</title>

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

	<script type= "text/javascript" src="../vendor/countries.js"></script>
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
<?php
		$sql = "SELECT * from users where id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Allocate Equipment </h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Allocation Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">

<div class="form-group">
<label class="col-sm-2 control-label">Select guard<span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="guard" class="form-control" required>
	<?php 
echo $site[0]["id"];
$sql = "SELECT * from  users" ;
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
echo $query->rowCount();
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
                            <option value="<?php echo $result->id;?>"><?php echo htmlentities($result->name);?></option>
<?php $cnt=$cnt+1; }} ?>
                            </select>

</div>
<label class="col-sm-2 control-label">Note<span style="color:red">*</span></label>
<div class="col-sm-4">
	<textarea name="note" class="form-control" required value="<?php echo htmlentities($result->description);?>">Enter text here...</textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Select equipment<span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="equipment" class="form-control" required>
	<?php 
echo $site[0]["id"];
$sql = "SELECT * from  equipment" ;
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
echo $query->rowCount();
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
                            <option value="<?php echo $result->id;?>"><?php echo htmlentities($result->make)." ".htmlentities($result->model)." ".htmlentities($result->license_no)." (".htmlentities($result->type).")";?></option>
<?php $cnt=$cnt+1; }} ?>
                            </select>

</div>

</div>






<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Allocate</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
						
					

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