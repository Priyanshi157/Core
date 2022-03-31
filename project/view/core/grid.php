<?php $pager = $this->getPager(); ?>
<?php $collections = $this->getCollection(); ?>
<?php $columns = $this->getColumns();  ?>
<?php $actions = $this->getActions(); ?>

<button class="btn btn-primary" id="addNew" type="button">Add</button><br><br>

<div>
<select onchange="ppr(this.value)" id="ppr">
    <option>Select</option>
    <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
        <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
    <?php endforeach;?>
</select>

<button><a href="<?php echo $this->getUrl('grid',null,['p'=>$pager->getStart()],true); ?>" style="<?php echo ($pager->getStart() == NULL) ? "pointer-events: none;" : "" ?> ">Start</a></button>

<button><a href="<?php echo $this->getUrl('grid',null,['p'=>$pager->getPrev()],true); ?>" style="<?php echo ($pager->getPrev() == NULL) ? "pointer-events: none;" : "" ?>">Prev</a></button>

<button>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pager->getCurrent(); ?> &nbsp;&nbsp;&nbsp;&nbsp;</button>

<button><a href="<?php echo $this->getUrl('grid',null,['p'=>$pager->getNext()],true); ?>" style="<?php echo ($pager->getNext() == NULL) ? "pointer-events: none;" : "" ?>">Next</a></button>

<button><a href="<?php echo $this->getUrl('grid',null,['p'=>$pager->getEnd()],true); ?>" style="<?php echo ($pager->getEnd() == NULL) ? "pointer-events: none;" : "" ?> ">End</a></button>
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

</script>