<?php $customers = $this->getCustomers(); ?>

<h3>Available Customer</h3>
<br><br>
<div class="card-footer">
  <button type="button" name="submit" class="btn btn-primary w-25" id="salesmanCustomerSubmitBtn">Save</button>
  <button type="button" class="btn btn-primary w-25 float-right" id="salesmanCustomerCancelBtn">Cancel</a></button>
</div>

<table class="table table-bordered table-striped">
    <tr>
        <th>Select</th>
        <th>Customer Id</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    <?php if(!$customers): ?>
            <tr>
                <td colspan="4">No Record Found.</td>
            </tr>
        <?php else: ?>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><input type="checkbox" name="customer[]" value='<?php echo $customer->customerId; ?>' <?php echo $this->selected($customer->customerId); ?> ></td>
            <td><?php echo $customer->customerId; ?></td>
            <td><?php echo $customer->firstName; ?></td>
            <td><?php echo $customer->lastName; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>

<script type="text/javascript">

jQuery("#salesmanCustomerCancelBtn").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman',['id' => null]); ?>");
    admin.load();
});

jQuery("#salesmanCustomerSubmitBtn").click(function(){
    admin.setForm(jQuery("#indexForm"));
    admin.setUrl("<?php echo $this->getSaveUrl();?>");
    admin.load();
});
</script>