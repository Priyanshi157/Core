<?php $customers = $this->getCustomers();  ?>
<?php $cart = $this->getCart(); ?>
<?php $customer = $cart->getCustomer(); ?>

<div class="row">
    <div class="col-sm-12"><br>
        <div class="form-group">
            <select class="form-control" id="cartChange">
            <option value="">Select</option>
                <?php foreach($customers as $cust): ?>
                    <option value="<?php echo $cust->customerId ?>" <?php echo ($cust->customerId == $customer->customerId) ? "selected" : "";?>><?php echo $cust->firstName." ".$cust->email; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div id="customerDetails">
    <h3>Customer Data</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $customer->firstName; ?></td>
                <td><?php echo $customer->lastName; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div id="cartAddress"></div>

<div id="paymentShiping"></div>
    
<div id="cartProduct"></div>

<div id="cartSubTotal" class="col-sm-6"></div>


<script>
    $(document).ready(function(){
        admin.setUrl("<?php echo $this->getUrl('indexBlock'); ?>");
        admin.load();

        $("#cartChange").change(function(){
            admin.setData({'id' : $(this).val()});
            admin.setUrl("<?php echo $this->getUrl('addCart',null,['id'=>null]);?>");
            admin.load();
        });
    });
</script>