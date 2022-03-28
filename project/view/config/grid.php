<?php $configs = $this->getConfigs(); ?>
<a href="<?php echo $this->getUrl('add',null,[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>

<div>

<select onchange="ppr(this.value)" id="ppr">
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


<table class="table border my-4">
  <thead>
    <tr>
      <th scope="col">Config Id</th>
      <th scope="col">Name</th>
      <th scope="col">Code</th>
      <th scope="col">Value</th>
      <th scope="col">Status</th>
      <th scope="col">Created At</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(!$configs): ?>
  		<tr><td colspan="10">No Record available.</td></tr>
  	<?php else: ?>
  		<?php foreach ($configs as $config): ?>
	  		<tr>
			    <td><?php echo $config->configId ?></td>
			    <td><?php echo $config->name ?></td>
			    <td><?php echo $config->code ?></td>
			    <td><?php echo $config->value ?></td>
			    <td><?php echo $config->getStatus($config->status) ?></td>
			    <td><?php echo $config->createdAt ?></td>
			    <td><a href="<?php echo $this->getUrl('edit','config',['id'=>$config->configId],true); ?>">Edit</a></td>
			    <td><a href="<?php echo $this->getUrl('delete','config',['id'=>$config->configId],true); ?>">Delete</a></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
  </tbody>
</table>

<script type="text/javascript">
function ppr(val) 
{
  window.location = "<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart(),'ppr'=>null]);?>&ppr="+val;
}
</script>
