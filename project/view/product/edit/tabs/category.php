<?php $categories = $this->getCategory(); ?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Select</th>
            <th>Category Id</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!$categories): ?>
        <tr>
            <td colspan="8">No Record Found</td>
        </tr>
        <?php else: ?>
            <?php foreach($categories as $category): ?>
        <?php $tag = ($this->selected($category->categoryId) == 'checked') ? 'exists' : 'new'; ?>
        <tr>
            <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->categoryId ?>" <?php echo $this->selected($category->categoryId); ?>> </td>
            <td><?php echo $category->categoryId; ?></td>
            <td><?php echo $category->getPath() ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<div class="card card-info">
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="categoryFormSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="categoryFromCancelBtn">Cancel</a></button>
    </div>
</div>

<script type="text/javascript">

jQuery("#categoryFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
	admin.load();
});

jQuery("#categoryFormSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
	admin.load();
});
</script>

