<?php $controllerCategory = new Controller_Category();
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
	<div class="container border">
	<form  method="POST" action="index.php?c=category&a=save">

		<div>
			<lable>Category_Dropdown: </lable>
				<select name="category[parentId]">
					<option value="NULL">Main category </option>
					<?php
						$result = $controllerCategory->getDataByPath();
						foreach($result as $key => $value):
					?>		
					<option value=<?php echo $key; ?> >
					<?php
							echo($value);
					?>
					</option>
					<?php endforeach; ?>					
					
	      		</select>
		</div>
			<label>Name : </label>
			<input class="col-sm-2 col-form-label" type="text" name="category[name]">
	  	<div>
		    

		</div>

	  	<div class="row mb-3">
	    	<label for="created" class="col-sm-2 col-form-label">Status</label>
	    	<div class="form-check">
		  		<input class="col-sm-2 col-form-label" type="radio" name="category[status]" id="flexRadioDefault1" value="1">
		  		<label class="form-check-label" for="flexRadioDefault1"> Active </label>
			</div>
			<div class="form-check">
		  		<input class="col-sm-2 col-form-label" type="radio" name="category[status]" id="flexRadioDefault2"  value="2" checked>
		  		<label class="form-check-label" for="flexRadioDefault2"> InActive </label>
			</div>
	  	</div>

	  	<button type="submit" class="btn btn-primary">Add</button>
	  	<a href="index.php?c=category&a=grid"><button type="button" class="btn btn-primary">Cancel</button></a> 
	</form>
	</div>
</body>
</html>