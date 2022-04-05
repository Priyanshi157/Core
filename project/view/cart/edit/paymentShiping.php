<?php $cart = $this->getCart(); ?>
<?php $shipingMethods = $this->getShipingMethods(); ?>
<?php $paymentMethods = $this->getPaymentMethods(); ?>

<div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Price Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Payment Method</th>
                        <th>Shiping Method</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php foreach ($paymentMethods as $paymentMethod) : ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>" id="paymentMethod<?php echo $paymentMethod->methodId ?>" <?php echo ($paymentMethod->methodId == $cart->paymentMethod)?'checked' : '' ?>>
                                <label for="paymentMethod<?php echo $paymentMethod->methodId ?>" class="custom-control-label"><?php echo $paymentMethod->name ?></label>

                            </div>
                            <?php endforeach;?>
                                    <div>
                                        <input type="button" id="cartPaymentMethodSubmitBtn" class="btn btn-primary" name="submit" value="Update">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php foreach ($shipingMethods as $shipingMethod) : ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="shipingMethod" value="<?php echo $shipingMethod->charge ?>" id="shipingMethod<?php echo $shipingMethod->methodId ?>" <?php echo ($shipingMethod->methodId == $cart->shipingMethod)?'checked' : '' ?>>
                                <label for="shipingMethod<?php echo $shipingMethod->methodId ?>" class="custom-control-label"><?php echo $shipingMethod->name." : ".$shipingMethod->charge ?>   </label>

                            </div>
                            <?php endforeach;?>
                                    </div>
                                    <div>
                                        <input type="button" id="cartShipingMethodSubmitBtn" class="btn btn-primary w-25" name="submit" value="Update">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $("#cartPaymentMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('savePaymentMethod') ?>");
        admin.load();
    });

    $("#cartShipingMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveShipingMethod') ?>");
        admin.load();
    });
</script>
