<?php $pager = $this->getPager(); ?>
<?php $collections = $this->getCollection(); ?>
<?php $columns = $this->getColumns();  ?>
<?php $actions = $this->getActions(); ?>

<h2>All Records</h2>

<div class="row d-flex justify-content-center">
    <div>
        <select onchange="ppr(this.value)" id="ppr">
            <option>Select</option>
            <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
                <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
            <?php endforeach;?>
        </select>

        <button type="button" value="<?php echo $this->getUrl(null,null,['p'=>$pager->getStart()]); ?>" style="<?php echo ($pager->getStart() == NULL) ? "pointer-events: none;" : "" ?> " class="pagerBtn">Start</a></button>

        <button type="button" value="<?php echo $this->getUrl(null,null,['p'=>$pager->getPrev()]); ?>" style="<?php echo ($pager->getPrev() == NULL) ? "pointer-events: none;" : "" ?> " class="pagerBtn">Prev</a></button>

        <button class="btn btn-primary" disabled>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pager->getCurrent(); ?> &nbsp;&nbsp;&nbsp;&nbsp;</button>

        <button type="button" value="<?php echo $this->getUrl(null,null,['p'=>$pager->getNext()]); ?>" style="<?php echo ($pager->getNext() == NULL) ? "pointer-events: none;" : "" ?> " class="pagerBtn">Next</a></button>

        <button type="button" value="<?php echo $this->getUrl(null,null,['p'=>$pager->getEnd()]); ?>" style="<?php echo ($pager->getEnd() == NULL) ? "pointer-events: none;" : "" ?> " class="pagerBtn">End</a></button>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-md-2">
        <div class="card card-primary">
            <button class="btn btn-block btn-primary" type="button" id="addNew">Add</button>
        </div>
    </div>
</div>
<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <?php foreach ($columns as $key => $column) :?>
            <th><?php echo $column['title'] ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $title => $action) :?>
            <th><?php echo $title ?></th>
        <?php endforeach; ?> 
    </tr>
    </thead>
    <tbody>
        <?php if(!$collections): ?>
            <td>No Data Available.</td>
        <?php else: ?>
            <?php foreach ($collections as $collection) :?>
            <tr>
                <?php foreach ($columns as $column):?>
                    <td><?php echo $this->getColumnData($column,$collection); ?></td>
                <?php endforeach; ?>
                <?php foreach($actions as $action): ?>
                    <?php $key = $columns['id']['key']; ?>
                    <td><button type="button" class="btn btn-info w-100 <?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<script type="text/javascript">
function ppr(val) 
{
  window.location = "<?php echo $this->getUrl(null,null,['p'=>$pager->getStart(),'ppr'=>null]);?>&ppr="+val;
}
</script>

<script type="text/javascript">
    $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('addBlock'); ?>");
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setType('GET');
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });
    
    $(".customer").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman_SalesmanCustomer'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".pagerBtn").click(function(){
        var data = $(this).val();
        admin.setUrl(data);
        admin.setType('GET');
        admin.load();
    });

    $("#ppr").change(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p'=>1,'ppr'=>null]); ?>&ppr="+data);
        admin.setType('GET');
        admin.load();
    });
</script>