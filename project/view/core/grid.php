<?php $pager = $this->getCollection()->getPagerModel(); ?>
<?php $headers = $this->getCollection()->getHeaders(); ?>
<?php $columns = $this->getCollection()->getColumns(); ?>
<?php $actions = $this->getCollection()->getActions(); ?>

<a href="<?php echo $this->getActionUrl('add'); ?>"><button type="button" class="btn btn-primary">Add</button></a><br><br>

<div>
<select onchange="ppr(this.value)" id="ppr">
    <option>Select</option>
    <?php foreach($pager->getPerPageCountOption() as $perPageCount) :?>  
        <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
    <?php endforeach;?>
</select>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$pager->getStart()]); ?>" style="<?php echo ($pager->getStart() == NULL) ? "pointer-events: none;" : "" ?> ">Start</a></button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$pager->getPrev()]); ?>" style="<?php echo ($pager->getPrev() == NULL) ? "pointer-events: none;" : "" ?>">Prev</a></button>

<button>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pager->getCurrent(); ?> &nbsp;&nbsp;&nbsp;&nbsp;</button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$pager->getNext()]); ?>" style="<?php echo ($pager->getNext() == NULL) ? "pointer-events: none;" : "" ?>">Next</a></button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$pager->getEnd()]); ?>" style="<?php echo ($pager->getEnd() == NULL) ? "pointer-events: none;" : "" ?> ">End</a></button>
</div>

<table class="table table-bordered my-4">
    <thead>
        <tr>
            <?php foreach ($headers as $header) :?>
                <th><?php echo $header ?></th>
            <?php endforeach; ?>
            <?php foreach ($actions as $title => $action) :?>
                <th><?php echo $title ?></th>
            <?php endforeach; ?> 
        </tr>
    </thead>
    <tbody>
        <?php foreach ($columns as $columnData) :?>
        <tr>
            <?php foreach ($columnData as $column):?>
                <td><?php echo $column ?></td>
            <?php endforeach; ?>
            <?php foreach ($actions as $action) :?>
                <td><a href="<?php echo $this->getActionUrl($action['title'],$columnData[0]); ?>"><?php echo $action['title'] ?></td>
            <?php endforeach; ?> 
        </tr>
        <?php endforeach; ?>
    </tbody> 
</table>

<script type="text/javascript">
function ppr(val) 
{
  window.location = "<?php echo $this->getUrl(null,null,['p'=>$pager->getStart(),'ppr'=>null]);?>&ppr="+val;
}
</script>