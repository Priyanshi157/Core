<?php $pager = $this->getPager(); ?>
<?php $collections = $this->getCollection(); ?>
<?php $columns = $this->getColumns();  ?>
<?php $actions = $this->getActions(); ?>

<button class="btn btn-primary" id="addNew" type="button">Add</button><br><br>

<div>
<select id="ppr">
    <option>Select</option>
    <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
        <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
    <?php endforeach;?>
</select>

<button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getStart()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getStart()) ? 'none' : ''?>">Start</button>

<button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getPrev()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getPrev()) ? 'none' : ''?>">Previous</button>

&nbsp;&nbsp;&nbsp;<?php echo "<b>".$pager->getCurrent()."</b>"?>&nbsp;&nbsp;&nbsp;

<button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getNext()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getNext()) ? 'none' : ''?>">Next</button>

<button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getEnd()]) ?>" style="pointer-events: <?php echo (!$this->getPager()->getEnd()) ? 'none' : ''?>">End</button>

</div>

<table class="table table-bordered my-4">
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
                    <td><button type="button" class="<?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
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