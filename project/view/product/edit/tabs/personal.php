<?php $product = $this->getProduct(); ?>

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Product Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="productid" name="product[productId]" value="<?php echo $product->productId;?>">
          <input type="text" class="form-control" id="name" name="product[name]" value="<?php echo $product->name; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Sku</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="product[sku]" value="<?php echo $product->sku; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="price" name="product[price]" value="<?php echo $product->price?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Msp</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="msp" name="product[msp]" value="<?php echo $product->msp?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Cost Price</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="costPrice" name="product[costPrice]" value="<?php echo $product->costPrice?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Quantity</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="qty" name="product[quantity]" value="<?php echo $product->quantity?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Tax</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="tax" name="product[tax]" value="<?php echo $product->tax?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Discount</label>
        <div class="col-sm-10">
          <input type="text" name="product[discount]" value="<?php echo $product->discount ?>">
            In Percentage:<input type="radio" name="discountMethod" value="1">&nbsp;&nbsp;&nbsp;
            In Money:<input type="radio" name="discountMethod" value="2" checked >
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="product[status]">
            <option value="1" <?php echo ($product->getStatus($product->status)=='Active')?'selected':'' ?>>Active</option>
            <option value="2" <?php echo ($product->getStatus($product->status)=='Inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="productSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="productFromCancelBtn">Cancel</a></button>
    </div>
</div>

<script type="text/javascript">

jQuery("#productFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
	admin.load();
});

jQuery("#productSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
	admin.load();
});
</script>

