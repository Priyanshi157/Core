<?php $cart = $this->getCart(); ?>
<?php $billingAddress = $cart->getBillingAddress(); ?>
<?php $shipingAddress = $cart->getShipingAddress(); ?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Billing Address</h3>
    </div>
  
    <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="billingAddress[firstName]" value="<?php echo $billingAddress->firstName ?>" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
            <input type="text" name="billingAddress[lastName]" value="<?php echo $billingAddress->lastName ?>" class="form-control" id="exampleInputLastName" placeholder="Enter Last Name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address ?>" class="form-control" id="exampleInputAddress" placeholder="Enter Address">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
            <input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>" class="form-control" id="exampleInputCity" placeholder="Enter City">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>" class="form-control" id="exampleInputState" placeholder="Enter State">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Postal Code</label>
            <div class="col-sm-10">
                <input type="number" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode" placeholder="Enter Postal Code">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-10">
                <input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>" class="form-control" id="exampleInputCountry" placeholder="Enter Country">
            </div>
        </div>

        <div class="custom-control custom-checkbox">
            <input class="custom-control-input custom-control-input-info" type="checkbox" id="customCheckbox4" onclick="same()">
            <label for="customCheckbox4" class="custom-control-label">Same as Shiping Address</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input custom-control-input-info" name="saveInBillingBook" value="1" type="checkbox" id="customCheckbox5">
            <label for="customCheckbox5" class="custom-control-label">Save to Address Book</label>
        </div>
      
    </div>
    <div class="card-footer">
        <div class="card-body">
        <input type="button" id="customerAddressSubmitBtn" class="btn btn-primary w-25" name="submit" value="Save">
        </div>
    </div>


    <div class="card-header">
        <h3 class="card-title">Shiping Address</h3>
    </div>
  
    <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
            <input type="text" name="shipingAddress[firstName]" value="<?php echo $shipingAddress->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
            <input type="text" name="shipingAddress[lastName]" value="<?php echo $shipingAddress->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" name="shipingAddress[address]" value="<?php echo $shipingAddress->address ?>" class="form-control" id="exampleInputAddress1" placeholder="Enter Address">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" name="shipingAddress[city]" value="<?php echo $shipingAddress->city ?>" class="form-control" id="exampleInputCity1" placeholder="Enter City">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
            <input type="text" name="shipingAddress[state]" value="<?php echo $shipingAddress->state ?>" class="form-control" id="exampleInputState1" placeholder="Enter State">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Postal Code</label>
            <div class="col-sm-10">
            <input type="number" name="shipingAddress[postalCode]" value="<?php echo $shipingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode1" placeholder="Enter Postal Code">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-10">
            <input type="text" name="shipingAddress[country]" value="<?php echo $shipingAddress->country ?>" class="form-control" id="exampleInputCountry1" placeholder="Enter Country">
            </div>
        </div>

        <div class="custom-control custom-checkbox">
            <input class="custom-control-input custom-control-input-info" name="saveInShipingBook" value="1" type="checkbox" id="customCheckbox6">
            <label for="customCheckbox6" class="custom-control-label">Save to Address Book</label>
        </div>
        </div>

        <div class="card-footer">
            <div class="card-body">
            <input type="button" id="customerAddressSubmitBtn" class="btn btn-primary w-25" name="submit" value="Save">
        </div>
        </div>
</div>


<script type="text/javascript">
    function same() {
        var checkedBox = document.getElementById("customCheckbox4");
        if(checkedBox.checked == true){
            var firstName = document.getElementById("exampleInputFirstName").value;
            var lastName = document.getElementById("exampleInputLastName").value;
            var address = document.getElementById("exampleInputAddress").value;
            var city = document.getElementById("exampleInputCity").value;
            var state = document.getElementById("exampleInputState").value;
            var postalCode = document.getElementById("exampleInputPosatalCode").value;
            var country = document.getElementById("exampleInputCountry").value;

            document.getElementById("exampleInputFirstName1").value = firstName; 
            document.getElementById("exampleInputLastName1").value = lastName; 
            document.getElementById("exampleInputAddress1").value = address; 
            document.getElementById("exampleInputCity1").value = city; 
            document.getElementById("exampleInputState1").value = state; 
            document.getElementById("exampleInputPosatalCode1").value = postalCode; 
            document.getElementById("exampleInputCountry1").value = country; 
        }
        else{
            document.getElementById("exampleInputFirstName1").value = null; 
            document.getElementById("exampleInputLastName1").value = null; 
            document.getElementById("exampleInputAddress1").value = null; 
            document.getElementById("exampleInputCity1").value = null; 
            document.getElementById("exampleInputState1").value = null; 
            document.getElementById("exampleInputPosatalCode1").value = null; 
            document.getElementById("exampleInputCountry1").value = null; 
        }
    }
</script>

<script>
    $("#customerAddressSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveCartAddress') ?>");
        admin.load();
    });

</script>
