<?php $categoryData =  $this->getCategory();   ?>
<?php $categories = $this->getCategories(); ?>

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Category Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="category[name]" value="<?php echo $categoryData->name; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Sub Category</label>
        <div class="col-sm-10">
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
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="category[status]">
	        <option value="1" <?php echo ($category->getStatus($category->status)=='Active')?'selected':'' ?>>Active</option>
	        <option value="2" <?php echo ($category->getStatus($category->status)=='Inactive')?'selected':'' ?>>Inactive</option>
	  </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="categorySubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>
</div>

<script type="text/javascript">
    jQuery("#categorySubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
        admin.load();
    });

    jQuery("#cancel").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]); ?>");
        admin.load();
    });

</script>

