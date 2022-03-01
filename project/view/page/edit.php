<?php $page = $this->getPage(); ?>

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
	<form method="POST" action="<?php echo $this->getUrl('save'); ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="pageId" name="page[pageId]" value="<?php echo $page->pageId; ?>">
	    </div>
	  </div>

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
	</form>
	</div>
</body>
</html>