<?php

$categoryData =  $this->getCategory();  
$categories = $this->getCategories();

?>
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
	    		<select name="category[status]">
				<option value="1" <?php echo ($category->getStatus($category->status)=='Active')?'selected':'' ?>>Active</option>
				<option value="2" <?php echo ($category->getStatus($category->status)=='Inactive')?'selected':'' ?>>Inactive</option>
			</select>
  		</div>

  		<div class="row justify-content-center">
  		<button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
  		<a href="<?php echo $this->getUrl('grid','category',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
	</div>
</form>
