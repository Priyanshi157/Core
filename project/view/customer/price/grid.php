<?php $products = $this->getProducts(); ?>

<div><br><br>
    <div>
        <button class="btn btn-primary w-25 float-left" type="button" id="customerPriceSubmitBtn">Save</button>
        <button class="btn btn-primary w-25 float-right" type="button" id="cancel">Cancel</button>
    </div>
</div>

<br><br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Product Id</th>
            <th>sku</th>
            <th>Name</th>
            <th>Price</th>
            <th>Salesman Price</th>
            <th>Customer Price</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!$products): ?>
            <tr>
                <td colspan = "7">No salesman assigned to this customer.</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][productId]" value="<?php echo $product->productId; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][salesmanPrice]" value="<?php echo $this->getSalesmanPrice($product->productId); ?>">
            <td><?php echo $product->productId ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $this->getSalesmanPrice($product->productId); ?>
            <td><input type="text" name="product[<?php echo $i ?>][price]" value="<?php echo $this->getCustomerPrice($product->productId) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>


<script type="text/javascript"> 
    $("#customerPriceSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','customer_price'); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>