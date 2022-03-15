<?php $admins = $this->getAdmins(); ?>

<a href="<?php echo $this->getUrl('add','admin',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>

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
      <th scope="col">Admin Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated AT</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(!$admins): ?>
  		<tr><td colspan="10">No Record available.</td></tr>
  	<?php else: ?>
  		<?php foreach ($admins as $admin): ?>
	  		<tr>
			    <td><?php echo $admin->adminId ?></td>
			    <td><?php echo $admin->firstName ?></td>
			    <td><?php echo $admin->lastName ?></td>
			    <td><?php echo $admin->email ?></td>
			    <td><?php echo $admin->getStatus($admin->status) ?></td>
			    <td><?php echo $admin->createdAt ?></td>
			    <td><?php echo $admin->updatedAt ?></td>
			    <td><a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->adminId]); ?>">Edit</a></td>
			    <td><a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->adminId],true); ?>">Delete</a></td>
			    
				
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