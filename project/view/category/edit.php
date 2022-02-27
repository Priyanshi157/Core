<?php

$categoryData =  $this->getCategory();  
$categories = $this->getCategories();

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
	<form method="POST" action="<?php echo $this->getUrl('save','category',['id'=>$categoryData->categoryId],true); ?>">
	  	<div>
			<lable>Category_Dropdown: </lable>
			<select name="category[parentId]" id="parentId">
                <option value="<?php echo null; ?>" <?php echo ($categoryData->parentId == NULL) ? 'selected' : ''; ?>>Root Category
                </option>
               	<?php foreach($categories as $category): ?>
                   	<?php if($categoryData->categoryId != $category->categoryId):  ?>
                        <option value="<?php echo $category->categoryId; ?>" <?php echo ($categoryData->parentId == $category->categoryId) ? 'selected' : ''; ?>><?php echo $this->getPath($category->categoryId,$category->path); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
	  	</div>

	  	<div class="row mb-4">
	    	<label for="name" class="col-sm-2 col-form-label">Name</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="name" name="category[name]" value="<?php echo $categoryData->name; ?>">
	    	</div>
	  	</div>

	  	

	  	
	  	<div class="row mb-3">
	    	<label for="created" class="col-sm-2 col-form-label">Status</label>
	    	<div class="row col-sm-10">
		    	<div class="form-check col-sm-6">
		    		<?php if($categoryData->status == 1){ ?>
			  		<input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault1" value="1" checked>
			  		<?php }else{ ?>
			  		<input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault1" value="1">
			  		<?php } ?>
			  		<label class="form-check-label col-sm-2" for="flexRadioDefault1"> Active </label>		
				</div>
				<div class="form-check col-sm-6">
					<?php if($categoryData->status == 2){ ?>
			 		<input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault2"  value="2" checked>
			  		<?php }else{ ?>
			  		<input class="form-check-input col-sm-4" type="radio" name="category[status]" id="flexRadioDefault2"  value="2" >
				  	<?php } ?>
			  		<label class="form-check-label col-sm-2" for="flexRadioDefault2"> InActive </label>
				</div>
	  		</div>

	  		<div class="row justify-content-center">
	  		<button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
	  		<a href="<?php echo $this->getUrl('grid','category',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>