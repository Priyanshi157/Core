<?php
require_once('Adapter.php');
$adapter = new Adapter();
try 
{
	$cid = $_GET['id'];
	if(!$cid)
	{
		throw new Exception("Invalid Request.", 1);
	}
	$category = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$cid'");
	if(count($category) > 0)
	{
		$cname = $category['name'];
		$price = $category['price'];
		$quantity = $category['quantity'];
		$status = $category['status'];
	}

} 
catch (Exception $e) 
{
	throw new Exception("System is unable to fetch.", 1);	
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
	<form method="POST" action="category.php?a=saveAction&id=<?php echo $cid ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="categoryid" name="category[categoryId]" value="<?php echo $cid;?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="name" name="category[name]" value="<?php echo $cname; ?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<?php if($status == 1){ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault1" value="1" checked>
			  	<?php }else{ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault1" value="1">
			  	<?php } ?>
			  <label class="form-check-label col-sm-2" for="flexRadioDefault1">
			    Active
			  </label>		
			</div>
			<div class="form-check col-sm-6">
				<?php if($status == 2){ ?>
			 <input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault2"  value="2" checked>
			  	<?php }else{ ?>
			  <input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault2"  value="2" >
			  	<?php } ?>
			 
			  <label class="form-check-label col-sm-2" for="flexRadioDefault2">
			    InActive
			  </label>
			</div>
	  </div>

	  <div class="row justify-content-center">
	  <button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
	  <a href="category.php?a=gridAction" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>