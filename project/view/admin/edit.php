<?php $admin = $this->getAdmin(); ?>
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
	<form method="POST" action="<?php echo $this->getUrl('admin','save',[],true); ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="adminId" name="admin[adminId]" value="<?php echo $admin['adminId']; ?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="admin[firstName]" value="<?php echo $admin['firstName']; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="admin[lastName]" value="<?php echo $admin['lastName']; ?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">Email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="admin[email]" value="<?php echo $admin['email'];?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">Password</label>
	    <div class="col-md-10">
	      <input type="password" class="form-control" id="password" name="admin[password]" value="<?php echo $admin['password'];?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<?php if($admin['status'] == 1){ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="admin[status]" id="flexRadioDefault1" value="1" checked>
			  	<?php }else{ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="admin[status]" id="flexRadioDefault1" value="1">
			  	<?php } ?>
			  <label class="form-check-label col-sm-2" for="flexRadioDefault1">
			    Active
			  </label>		
			</div>
			<div class="form-check col-sm-6">
				<?php if($admin['status'] == 2){ ?>
			 <input class="form-check-input col-sm-4" type="radio" name="admin[status]" id="flexRadioDefault2"  value="2" checked>
			  	<?php }else{ ?>
			  <input class="form-check-input col-sm-4" type="radio" name="admin[status]" id="flexRadioDefault2"  value="2" >
			  	<?php } ?>
			 
			  <label class="form-check-label col-sm-2" for="flexRadioDefault2">
			    InActive
			  </label>
			</div>
	  </div>

	  <div class="row justify-content-center">
	  <button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
	  <a href="<?php echo $this->getUrl('admin','grid',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>