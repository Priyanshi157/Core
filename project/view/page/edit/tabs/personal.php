<?php $page = $this->getPage(); ?>

<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Page Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="pageId" name="page[pageId]" value="<?php echo $page->pageId; ?>">
          <input type="text" class="form-control" id="name" name="page[name]" value="<?php echo $page->name; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Code</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="code" name="page[code]" value="<?php echo $page->code; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="content" name="page[content]" value="<?php echo $page->content; ?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="page[status]">
            <option value="1" <?php echo ($page->getStatus($page->status)=='Active')?'selected':'' ?>>Active</option>
            <option value="2" <?php echo ($page->getStatus($page->status)=='Inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="pageSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>
</div>

<script>
$("#pageSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','page'); ?>");
    admin.load();
});
</script>
