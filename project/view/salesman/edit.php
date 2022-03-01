<?php

$salesman = $this->getsalesman();

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
	<form method="POST" action="<?php echo $this->getUrl('save','salesman',['id'=>$salesman->salesmanId],true); ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="salesmanId" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId;?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="salesman[firstName]" value="<?php echo $salesman->firstName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="salesman[lastName]" value="<?php echo $salesman->lastName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="salesman[email]" value="<?php echo $salesman->email?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">mobile</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="mobile" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<select name="salesman[status]">
					<option value="1" <?php echo ($salesman->getStatus($salesman->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($salesman->getStatus($salesman->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</div>
	  	</div>

	  	<div class="row justify-content-center">
	  		<button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
	  		<a href="<?php echo $this->getUrl('grid','salesman',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>