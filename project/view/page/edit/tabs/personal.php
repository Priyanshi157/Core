<?php $page = $this->getPage(); ?>
    
<input type="hidden" class="form-control" id="pageId" name="page[pageId]" value="<?php echo $page->pageId; ?>">

<div class="row mb-4">
  <label for="name" class="col-sm-2 col-form-label">Name</label>
  <div class="col-md-10">
    <input type="text" class="form-control" id="name" name="page[name]" value="<?php echo $page->name; ?>">
  </div>
</div>

<div class="row mb-4">
  <label for="price" class="col-sm-2 col-form-label">Code</label>
  <div class="col-md-10">
    <input type="text" class="form-control" id="code" name="page[code]" value="<?php echo $page->code; ?>">
  </div>
</div>

<div class="row mb-4">
  <label for="price" class="col-sm-2 col-form-label">Content</label>
  <div class="col-md-10">
    <input type="text" class="form-control" id="content" name="page[content]" value="<?php echo $page->content; ?>">
  </div>
</div>

<div class="row mb-3">
  <label for="created" class="col-sm-2 col-form-label">Status</label>
  <div class="row col-sm-10">
    <div class="form-check col-sm-6">
    
	  	<select name="page[status]">
			<option value="1" <?php echo ($page->getStatus($page->status)=='Active')?'selected':'' ?>>Active</option>
			<option value="2" <?php echo ($page->getStatus($page->status)=='Inactive')?'selected':'' ?>>Inactive</option>
		</select>

	</div>
</div>

<div class="row justify-content-center">
<button type="submit" class="btn btn-primary col-sm-2 m-1">Save</button>
<a href="<?php echo $this->getUrl('grid','page',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
</div>
