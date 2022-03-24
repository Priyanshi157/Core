<?php $customers = $this->getCustomers();  ?>
<?php $cart = $this->getCart(); ?>
<?php $customer = $cart->customer; ?>
<?php $billingAddress = $cart->billingAddress; ?>
<?php $shipingAddress = $cart->shipingAddress; ?>
<?php $item = $cart->item; ?>
<?php $products = $this->getProducts(); ?>
<?php $items = $this->getItems(); ?>
<?php $payment = $this->getPaymentMethods(); ?>
<?php $shiping = $this->getShipingMethods(); ?>
<?php $disabled = (!$items) ? 'disabled' : ""; ?>

<select onchange="change(this.value)">
	<option value="">Select</option>
	<?php foreach($customers as $cust): ?>
	<option value="<?php echo $cust->customerId ?>"><?php echo $cust->customerId."  ".$cust->firstName." ".$cust->lastName; ?></option>
	<?php endforeach; ?>
</select>

<button><a href="<?php echo $this->getUrl('grid','cart',[],true); ?>">Cancel</a></button>

<h2><b>Customer Data</b></h2>
<table>
	<tr>
		<td>First Name</td>
		<td><input type="text" value="<?php echo $customer->firstName; ?>"></td>
		<td>Last Name</td>
		<td><input type="text" value="<?php echo $customer->lastName; ?>"></td>
	</tr>
</table><br>

<form action="<?php echo $this->getUrl('saveCartAddress'); ?>" method="post">
	<table border="1">
		<tr>
			<th>Billing Address</th>
			<th>Shiping Address</th>
		</tr>
		<tr>
			<td>
				<table border="1">
					<tr>
						<input type="hidden" name="billingAddress[billing]" value="1">
						<input type="hidden" name="billingAddress[shiping]" value="2">
						<td>First Name</td>
						<td><input type="text" name="billingAddress[firstName]" id="firstName" value="<?php echo $billingAddress->firstName; ?>"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" name="billingAddress[lastName]" id="lastName" value="<?php echo $billingAddress->lastName; ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="billingAddress[address]" id="address" value="<?php echo $billingAddress->address; ?>"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="billingAddress[city]" id="city" value="<?php echo $billingAddress->city; ?>"></td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="billingAddress[state]" id="state" value="<?php echo $billingAddress->state; ?>"></td>
					</tr>
					<tr>
						<td>Postal Code</td>
						<td><input type="text" name="billingAddress[postalCode]" id="postalCode" value="<?php echo $billingAddress->postalCode; ?>"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="billingAddress[country]" id="country" value="<?php echo $billingAddress->country; ?>"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" name="sameAsShiping" id="ship" onclick="same()">Same as shiping address
							<br>
							<input type="checkbox" name="saveInBillingBook" value=1>Save in address book
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table border="1">
					<tr>
						<input type="hidden" name="shipingAddress[billing]" value="2">
						<input type="hidden" name="shipingAddress[shiping]" value="1">
						<td>First Name</td>
						<td><input type="text" name="shipingAddress[firstName]" id="firstName1" value="<?php echo $shipingAddress->firstName; ?>"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" name="shipingAddress[lastName]" id="lastName1" value="<?php echo $shipingAddress->lastName; ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="shipingAddress[address]" id="address1" value="<?php echo $shipingAddress->address; ?>"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="shipingAddress[city]" id="city1" value="<?php echo $shipingAddress->city; ?>"></td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="shipingAddress[state]" id="state1" value="<?php echo $shipingAddress->state; ?>"></td>
					</tr>
					<tr>
						<td>Postal Code</td>
						<td><input type="text" name="shipingAddress[postalCode]" id="postalCode1" value="<?php echo $shipingAddress->postalCode; ?>"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="shipingAddress[country]" id="country1" value="<?php echo $shipingAddress->country; ?>"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" name="saveInShipingBook">save in address book
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="save">
			</td>
		</tr>
	</table>
</form>

<table border="1">
	<tr>
		<th>Payment Method</th>
		<th>Shiping Method</th>
	</tr>

	<tr>
		<td>
			<form action="<?php echo $this->getUrl('savePaymentMethod') ?>" method="post">
				<?php foreach ($payment as $paymentMethod) : ?>
                    
                        <input type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>" <?php echo ($paymentMethod->methodId == $cart->cart->paymentMethod)?'checked' : '' ?>><?php echo $paymentMethod->name ?>
                    <br>
                <?php endforeach;?>
				<input type="submit" value="Update">
			</form>
		</td>

		<td>
			<form action="<?php echo $this->getUrl('saveShipingMethod') ?>" method="post">
				<?php foreach ($shiping as $shipingMethod) : ?>
                    
                        <input type="radio" name="shipingMethod" value="<?php echo $shipingMethod->methodId ?>" <?php echo ($shipingMethod->methodId == $cart->cart->shipingMethod)?'checked' : '' ?>><?php echo $shipingMethod->name ?>
                        <?php echo $shipingMethod->charge ?>
                    	<br>
                <?php endforeach;?><br>
				<input type="submit" value="Update">
			</form>
		</td>
	</tr>
</table><br>

<div id="productTable">
<form action="<?php echo $this->getUrl('addCartItem') ?>" method="post">
	<input type="Submit" value="Add Item">
	<button type="button" value="" id="hideProduct">Cancel</button>
	<table border="1">
		<tr>
			<th>Image</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>SubTotal</th>
			<th>Action</th>
		</tr>
		<?php $i = 0; ?>
		<?php foreach($products as $product): ?>
		<tr>
			<?php if($product->getBase()): ?>
				<td><img src="Media/Product/<?php echo $product->getBase()->name; ?>" width="50" hight="50"></td>
			<?php else: ?>
				<td><b>No Image</b></td>
			<?php endif; ?>
			<td><?php echo $product->name; ?></td>
			<td><?php echo $product->price; ?></td>
			<td><input type="number" name="cartItem[<?php echo $i ?>][quantity]" min="1"></td>
			<td>200</td>
			<td><input type="checkbox" name="cartItem[<?php echo $i ?>][productId]" value="<?php echo $product->productId ?>"></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</form>
</div>
<form action="<?php echo $this->getUrl('cartItemUpdate'); ?>" method="post">
	<input type="submit" value="Update">
	<button type="button" value="" id="showProduct">New Item</button>
	<table border="1">
		<tr>
			<th>Image</th>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>RowTotal</th>
			<th>Action</th>
		</tr>
		<?php if(!$items): ?>
		<tr>
			<td colspan="6">No item found.</td>
		</tr>
		<?php else: ?>
		<?php $i = 0; ?>
		<?php foreach($items as $item): ?>
		<tr>
			<input type="hidden" name="cartItem[<?php echo $i ?>][itemId]" value="<?php echo $item->itemId ?>">
			<input type="hidden" name="cartItem[<?php echo $i ?>][productId]" value="<?php echo $item->productId ?>">
			<?php if($item->getProduct()->getBase()): ?>
				<td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
			<?php else: ?>
				<td><b>No Image</b></td>
			<?php endif; ?>
			<td><?php echo $item->getProduct()->name; ?></td>
			<td><input type="number" name="cartItem[<?php echo $i ?>][quantity]" value="<?php echo $item->quantity; ?>" min = "1"></td>
			<td><?php echo $item->getProduct()->price; ?></td>
			<td><?php echo $item->itemTotal; ?></td>
			<td><a href="<?php echo $this->getUrl('deleteCartItem',null,['itemId' => $item->itemId]) ?>">Remove</a></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
		<?php endif;?>
	</table>
</form>
<form action="<?php echo $this->getUrl('placeOrder') ?>" method="post">
	<table border="1">
		<tr>
			<td>Sub Total</td>
			<td><?php echo $this->getTotal(); ?></td>
		</tr>
		<tr>
			<td>Shiping Cost</td>
			<td><?php echo $cart->cart->shipingCost; ?></td>
		</tr><tr>
			<td>Tax</td>
			<td><?php echo $this->getTax($cart->cart->cartId); ?></td>
		</tr><tr>
			<td>Discount</td>
			<td><?php echo $cart->cart->discount; ?></td>
		</tr><tr>
			<td width="70%" align="right">Grand Total</td>

            <input type="hidden" name="grandTotal" value="<?php echo $this->getTotal() + ($cart->cart->shippingCost) + $this->getTax($cart->cart->cartId) - $cart->cart->discount; ?>">

            <input type="hidden" name="discount" value="<?php echo $cart->cart->discount;    ?>">
            <input type="hidden" name="taxAmount" value="<?php echo $this->getTax($cart->cart->cartId); ?>">
            <td><?php echo $this->getTotal() + ($cart->cart->shipingCost) + $this->getTax($cart->cart->cartId) - $cart->cart->discount; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" <?php echo $disabled; ?> value="Place Order"></td>
		</tr>
	</table>
</form>

<script type="text/javascript">
function change(val) 
{
	window.location = "<?php echo $this->getUrl('addCart',null,['id'=>null]);?>&id="+val;
}

function same() 
{
	var checkedBox = document.getElementById("ship");
	if(checkedBox.checked == true)
	{
		var firstName = document.getElementById("firstName").value;
		var lastName = document.getElementById("lastName").value;
		var address = document.getElementById("address").value;
		var city = document.getElementById("city").value;
		var state = document.getElementById("state").value;
		var postalCode = document.getElementById("postalCode").value;
		var country = document.getElementById("country").value;

		document.getElementById("firstName1").value = firstName; 
		document.getElementById("lastName1").value = lastName; 
		document.getElementById("address1").value = address; 
		document.getElementById("city1").value = city; 
		document.getElementById("state1").value = state; 
		document.getElementById("postalCode1").value = postalCode; 
		document.getElementById("country1").value = country; 
	}
	else
	{
		document.getElementById("firstName1").value = null; 
		document.getElementById("lastName1").value = null; 
		document.getElementById("address1").value = null; 
		document.getElementById("city1").value = null; 
		document.getElementById("state1").value = null; 
		document.getElementById("postalCode1").value = null; 
		document.getElementById("country1").value = null; 
	}
}

</script>

<script>
$(document).ready(function(){
    $("#productTable").hide();
    $("#showProduct").click(function(){
        $("#productTable").show();
    });
    $("#hideProduct").click(function(){
        $("#productTable").hide();
    });
});
</script>