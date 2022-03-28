<?php $order = $this->getOrder();  ?>
<?php $billingAddress = $order->getBillingAddress(); ?>
<?php $shipingAddress  = $order->getShipingAddress(); ?>
<?php $items = $order->getItems(); ?>

<a href="<?php echo $this->getUrl('grid','cart',[],true); ?>" class="btn btn-primary ">Home</a>
<h3><b>Address Summary</b></h3>
<table border="1">
    <tr>
        <th>Billing Address</th>
        <th>Shiping Address</th>
    </tr>
    <tr>
        <td>
            <?php if($billingAddress): ?>
                <table border="1">
                    <tr>
                        <td>First Name</td>
                        <td><input value="<?php echo $billingAddress->firstName; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input value="<?php echo $billingAddress->lastName; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input value="<?php echo $billingAddress->email; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><input value="<?php echo $billingAddress->mobile; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input value="<?php echo $billingAddress->address; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input value="<?php echo $billingAddress->city; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input value="<?php echo $billingAddress->state; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td><input value="<?php echo $billingAddress->postalCode; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input value="<?php echo $billingAddress->country; ?>" disabled></td>
                    </tr>
                </table>
            <?php endif; ?>
        </td>
        <td>
            <?php if($shipingAddress): ?>
                <table border="1">
                    <tr>
                        <td>First Name</td>
                        <td><input value="<?php echo $shipingAddress->firstName; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input value="<?php echo $shipingAddress->lastName; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input value="<?php echo $shipingAddress->email; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><input value="<?php echo $shipingAddress->mobile; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input value="<?php echo $shipingAddress->address; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input value="<?php echo $shipingAddress->city; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input value="<?php echo $shipingAddress->state; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td><input value="<?php echo $shipingAddress->postalCode; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input value="<?php echo $shipingAddress->country; ?>" disabled></td>
                    </tr>
                </table>
            <?php endif; ?>
        </td>
    </tr>
</table>
<br><br>

<h3><b>Order Summary</b></h3>
<table class="table border my-4">
    <tr align="center">
        <th>ItemId </th>
        <th>OrderId </th>
        <th>ProductId </th>
        <th>Image </th>
        <th>Name </th>
        <th>Quantity </th>
        <th>Price </th>
        <th>Tax </th>
        <th>TaxAmount </th>
        <th>Discount </th>
    </tr>
    <?php if(!$items): ?>
    <tr>
        <td colspan="6">No item found</td>
    </tr>
    <?php else: ?>
    <?php $i = 0; ?>
    <?php foreach($items as $item): ?>
    <tr align="center">
        <td><?php echo $item->itemId ?></td>
        <td><?php echo $item->orderId ?></td>
        <td><?php echo $item->productId ?></td>
        <?php if($item->getProduct()->getThumb()) : ?>
            <td><img src="<?php echo $item->getProduct()->getThumb()->getImagePath(); ?>" alt="image not found" width="50" hight="50"></td>
        <?php else: ?>
            <td><b>No Image</b></td>
        <?php endif; ?>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->quantity; ?></td>
        <td><?php echo $item->price; ?></td>
        <td><?php echo $item->tax; ?></td>
        <td><?php echo $item->taxAmount; ?></td>
        <td><?php echo $item->discount; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php endif;?>
    <tr>
        <td>Grand Total</td>
        <td align="right" colspan="9"><?php echo $order->grandTotal; ?></td>
    </tr>
</table>
<br>
