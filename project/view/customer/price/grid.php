<?php $products = $this->getProducts(); ?>
<form action="<?php echo $this->getUrl('save','customer_price') ?>" method="post">
    <input type="submit" value="save">
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>sku</th>
            <th>Name</th>
            <th>Price</th>
            <th>Salesman Price</th>
            <th>Customer Price</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspan = "7">Salesman not assign</td>
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
    </table>
</form>
<?php if($products): ?>
    <div>
    <script type="text/javascript">
    function ppr() 
    {
        const pprValue = document.getElementById('ppr').selectedOptions[0].value;
        let url = window.location.href;
        if(!url.includes('ppr'))
        {
            url += '&ppr=20';
        }

        const myArray = url.split("&");
        for(i = 0 ; i < myArray.length ; i++)
        {
            if(myArray[i].includes('p='))
            {
                myArray[i] = 'p=1';
            }

            if(myArray[i].includes('ppr='))
            {
                myArray[i] = 'ppr='+pprValue;
            }
        }
        const str = myArray.join("&");
        location.replace(str);
    }
    </script>

    <select onchange="ppr()" id="ppr">
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
<?php endif; ?>