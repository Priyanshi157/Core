<?php $cart = $this->getCart(); ?>
<?php $items = $this->getItems(); ?>
<?php $disabled = (!$items)?'disabled':""; ?>

<div>
	<form action="<?php echo $this->getUrl('placeOrder') ?>" method="post">
		<table border="1">
			<tr>
				<td>Sub Total</td>
				<td><?php echo $this->getTotal(); ?></td>
			</tr>
			<tr>
				<td>Shiping Charge</td>
				<td><?php echo $cart->shipingCost; ?></td>
			</tr>
			<tr>
				<td>Tax</td>
				<td><?php echo $this->getTax($cart->cartId); ?></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><?php echo $cart->discount; ?></td>
			</tr>
			<tr>
				<td>Grand Total</td>
				<td><?php echo $this->getTotal() + $cart->shipingCost + $this->getTax($cart->cartId) - $cart->discount; ?></td>
				
			</tr>
			<tr>
				<?php $data = [
				'grandTotal'=>$this->getTotal()+$cart->shipingCost+ $this->getTax($cart->cartId) - $cart->discount,
				'taxAmount'=>$this->getTax($cart->cartId),
				'discount'=>$cart->discount
			]?>
				<td></td>
				<td><button type="button" class="btn btn-primary" id="placeOrderBtn" value="<?php //echo $data['grandTotal']." ".  ?>" <?php echo $disabled; ?>>Place Order</button></td>
			</tr>
		</table>
	</form>
</div>

<script>
    $(document).ready(function(){
        $("#productTable").hide();

        $("#placeOrderBtn").click(function(){
            admin.setForm(jQuery("#indexForm"));
            admin.setType('POST');
            admin.setData({'grandTotal':<?php echo $data['grandTotal']?>,'taxAmount':<?php echo $data['taxAmount']?>,'discount':<?php echo $data['discount']?>});
            admin.setUrl("<?php echo $this->getUrl('placeOrder') ?>");
            admin.load();
        });
    });
</script>