<?php $product = $this->getProduct(); ?>
<?php $categories=$this->getCategories(); ?>  
<form method="POST" action="<?php echo $this->getUrl('save','product',[],true); ?>">
  <div class="row mb-4">
    <div class="col-md-10">
      <input type="hidden" class="form-control" id="productid" name="product[productId]" value="<?php echo $product->productId;?>">
    </div>
  </div>


  <div class="row mb-4">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="name" name="product[name]" value="<?php echo $product->name; ?>">
    </div>
  </div>

  <div class="row mb-4">
    <label for="price" class="col-sm-2 col-form-label">Price</label>
    <div class="col-md-10">
      <input type="number" class="form-control" id="price" name="product[price]" value="<?php echo $product->price?>">
    </div>
  </div>

  <div class="row mb-4">
    <label for="price" class="col-sm-2 col-form-label">MSP</label>
    <div class="col-md-10">
      <input type="number" class="form-control" id="msp" name="product[msp]" value="<?php echo $product->msp?>">
    </div>
  </div>

  <div class="row mb-4">
    <label for="price" class="col-sm-2 col-form-label">Cost Price</label>
    <div class="col-md-10">
      <input type="number" class="form-control" id="costPrice" name="product[costPrice]" value="<?php echo $product->costPrice?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
    <div class="col-md-10">
      <input type="number" class="form-control" id="qty" name="product[quantity]" value="<?php echo $product->quantity?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">Tax</label>
    <div class="col-md-10">
      <input type="number" class="form-control" id="tax" name="product[tax]" value="<?php echo $product->tax?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="created" class="col-sm-2 col-form-label">Discount</label>
    <div class="row col-sm-10">
      <div class="form-check col-sm-6">
        <input type="text" name="product[discount]" value="<?php echo $product->discount ?>">
        In Percentage:<input type="radio" name="discountMethod" value="1">&nbsp;&nbsp;&nbsp;
        In Money:<input type="radio" name="discountMethod" value="2" checked >
    </div>
  </div>

  <div class="row mb-3">
    <label for="created" class="col-sm-2 col-form-label">Status</label>
    <div class="row col-sm-10">
      <div class="form-check col-sm-6">
        <select name="product[status]">
        <option value="1" <?php echo ($product->getStatus($product->status)=='Active')?'selected':'' ?>>Active</option>
        <option value="2" <?php echo ($product->getStatus($product->status)=='Inactive')?'selected':'' ?>>Inactive</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
      <div class="col-md-10">
        <table border="1" width="100%">
      <tr>
        <th>Select</th>
        <th>Category Id</th>
        <th>Category</th>
      </tr>
      <?php if(!$categories): ?>
      <tr>
        <td colspan="3">No category Found</td>
      </tr>
      <?php else: ?>
      <?php foreach($categories as $category): ?>
      <?php $tag = ($this->selected($category->categoryId) == 'checked') ? 'exists' : 'new' ?>
      <tr>
        <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->categoryId ?>" <?php echo $this->selected($category->categoryId); ?>> </td>
        <td><?php echo $category->categoryId; ?></td>
        <td><?php echo $this->getPath($category->categoryId,$category->path) ?></td>
      </tr>

      <?php endforeach; ?>

      <?php endif; ?>
    </table>

    </div>
  </div>

  <div class="row justify-content-center">
  <button type="submit" class="btn btn-primary col-sm-2 m-1">Save</button>
  <a href="<?php echo $this->getUrl('grid','product',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
	</div>
</form>
