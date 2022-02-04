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
	<form  method="POST" action="customer.php?a=saveAction">
	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="firstName">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="lastName">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="email">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">mobile</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="mobile" name="mobile">
	    </div>
	  </div>

	  
	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="form-check">
		  <input class="col-sm-2 col-form-label" type="radio" name="status" id="flexRadioDefault1" value="1">
		  <label class="form-check-label" for="flexRadioDefault1">
		    Active
		  </label>
		</div>
		<div class="form-check">
		  <input class="col-sm-2 col-form-label" type="radio" name="status" id="flexRadioDefault2"  value="2" checked>
		  <label class="form-check-label" for="flexRadioDefault2">
		    InActive
		  </label>
		</div>
	  </div>

	  <button type="submit" class="btn btn-primary">Add</button>
	  <a href="customer.php?a=gridAction"><button type="button" class="btn btn-primary">Cancel</button></a>
	</form>
	</div>
</body>
</html>