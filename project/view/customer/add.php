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
		<form  method="POST" action="index.php?c=customer&a=save"> 
		  	<div class="row mb-4">
		    	<label for="name" class="col-sm-2 col-form-label">First Name</label>
		    	<div class="col-md-10">
		      		<input type="text" class="form-control" id="firstName" name="customer[firstName]" value="mahek">
		    	</div>
		  	</div>

		  	<div class="row mb-4">
			    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
			    <div class="col-md-10">
			    	<input type="text" class="form-control" id="lastName" name="customer[lastName]" value="kalol">
		    	</div>
		  	</div>

		  	<div class="row mb-4">
			    <label for="name" class="col-sm-2 col-form-label">email</label>
			    <div class="col-md-10">
			    	<input type="email" class="form-control" id="email" name="customer[email]" value="mahek@gmail.com">
			    </div>
		  	</div>


		  	<div class="row mb-4">
			    <label for="price" class="col-sm-2 col-form-label">mobile</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="mobile" name="customer[mobile]" value="7845125874">
			    </div>
		  	</div>

		  
		  	<div class="row mb-3">
			    <label for="created" class="col-sm-2 col-form-label">Status</label>
		    	<div class="form-check">
			  		<input class="col-sm-2 col-form-label" type="radio" name="customer[status]" id="flexRadioDefault1" value="1">
			  		<label class="form-check-label" for="flexRadioDefault1">Active</label>
				</div>
				<div class="form-check">
			  		<input class="col-sm-2 col-form-label" type="radio" name="customer[status]" id="flexRadioDefault2"  value="2" checked>
			  		<label class="form-check-label" for="flexRadioDefault2">InActive</label>	
				</div>
		  	</div>

		  	<div class="row mb-4">
			    <label for="price" class="col-sm-2 col-form-label">Address</label>
			    <div class="col-md-10">
			      <textarea id="address" name="address[address]" rows="4" cols="50" value="paldi"></textarea>
			    </div>
		  	</div>
		
			<div class="row mb-4">
			    <label for="price" class="col-sm-2 col-form-label">Postal Code</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="postalCode" name="address[postalCode]" value="389151">
			    </div>
			</div>
			
			<div class="row mb-4">
			    <label for="price" class="col-sm-2 col-form-label">city</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="city" name="address[city]" value="ahmedabad">
			    </div>
		  	</div>
		
			<div class="row mb-4">
			    <label for="price" class="col-sm-2 col-form-label">State</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="state" name="address[state]" value="gujrat">
			    </div>
		  	</div>
			<div class="row mb-4">
			    <label for="price" class="col-sm-2 col-form-label">Country</label>
			    <div class="col-md-10">
			      <input type="text" class="form-control" id="country" name="address[country]" value="india">
			    </div>
		  	</div>

			<div class="row mb-4">
			    <input type="checkbox" id="billing" name="address[billing]" value="1">
				<label for="vehicle1">Billing</label><br>
				<input type="checkbox" id="shiping" name="address[shiping]" value="1">
				<label for="vehicle2"> Shipping </label><br>
		  	</div>

		  	<button type="submit" class="btn btn-primary">Add</button>
		  	<a href="index.php?c=customer&a=grid"><button type="button" class="btn btn-primary">Cancel</button></a>
		</form>
	</div>
</body>
</html>