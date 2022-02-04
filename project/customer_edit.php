<?php
require_once('Adapter.php');
$adapter = new Adapter();

if($_GET['id'])
{
	$cid = $_GET['id'];
	$row = $adapter->fetchRow("SELECT * FROM customer WHERE customerId = '$cid'");
	if(count($row) > 0)
		{
			$firstName = $row['firstName'];
			$lastName = $row['lastName'];
			$email = $row['email'];
			$mobile = $row['mobile'];
			$status = $row['status'];
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title></title>
</head>
<body>
	<div class="container">
	<form method="POST" action="customer.php?a=saveAction&id=<?php echo $cid ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="customerid" name="customerid" value="<?php echo $cid;?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">mobile</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<?php if($status == 1){ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="status" id="flexRadioDefault1" value="1" checked>
			  	<?php }else{ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="status" id="flexRadioDefault1" value="1">
			  	<?php } ?>
			  <label class="form-check-label col-sm-2" for="flexRadioDefault1">
			    Active
			  </label>		
			</div>
			<div class="form-check col-sm-6">
				<?php if($status == 2){ ?>
			 <input class="form-check-input col-sm-4" type="radio" name="status" id="flexRadioDefault2"  value="2" checked>
			  	<?php }else{ ?>
			  <input class="form-check-input col-sm-4" type="radio" name="status" id="flexRadioDefault2"  value="2" >
			  	<?php } ?>
			 
			  <label class="form-check-label col-sm-2" for="flexRadioDefault2">
			    InActive
			  </label>
			</div>
	  </div>

	  <div class="row justify-content-center">
	  <button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
	  <a href="customer.php?a=gridAction" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>