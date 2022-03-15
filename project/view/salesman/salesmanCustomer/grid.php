<?php $customers = $this->getCustomers(); ?>
<h3>Available Customer</h3>
<form action="<?php echo $this->getUrl('save','Salesman_SalesmanCustomer',['id'=> $this->getSalesmanId()],true) ?>" method="post">
    <input type="submit" value="save">
    <button><a href="<?php echo $this->getUrl('grid','Salesman'); ?>">Cancel</a></button>
    <table border="1" width="100%">
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
</form>
<div>
<select onchange="ppr(this.value)" id="ppr">
    <option>Select</option>
    <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
        <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
    <?php endforeach;?>
</select>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()]); ?>" style="<?php echo ($this->getPager()->getStart() == NULL) ? "pointer-events: none;" : "" ?> ">Start</a></button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()]); ?>" style="<?php echo ($this->getPager()->getPrev() == NULL) ? "pointer-events: none;" : "" ?>">Prev</a></button>

<button>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->getPager()->getCurrent(); ?> &nbsp;&nbsp;&nbsp;&nbsp;</button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()]); ?>" style="<?php echo ($this->getPager()->getNext() == NULL) ? "pointer-events: none;" : "" ?>">Next</a></button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()]); ?>" style="<?php echo ($this->getPager()->getEnd() == NULL) ? "pointer-events: none;" : "" ?> ">End</a></button>
</div>

<script type="text/javascript">
function ppr(val) 
{
  window.location = "<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart(),'ppr'=>null]);?>&ppr="+val;
}
</script>
