<?php  $categories = $this->getCategories(); ?>
<a href="<?php echo $this->getUrl('add','category') ?>"><button type="button" class="btn btn-primary">Add</button></a>

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
      <th scope="col">Category Id</th>
      <th scope="col">Name</th>
      <th scope="col">Base Image</th>
      <th scope="col">Thumb Image</th>
      <th scope="col">Small Image</th>
      <th scope="col">Status</th>
      <th scope="col">CreatedAt</th>
      <th scope="col">UpdatedAt</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      <th scope="col">Gallery</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(!$categories): ?>
  		<tr><td colspan="10">No Record available.</td></tr>
  	<?php else: ?>
  		<?php foreach ($categories as $category): ?>
	  		<tr>
			    <td><?php  echo $category->categoryId; ?></td>
                <td><?php echo $this->getPath($category->categoryId,$category->path); ?></td>
                <?php if($category->base ): ?>
                <td><img src="<?php echo 'Media/Category/'.$category->getBase()->name; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No base image</td>
                <?php endif; ?>

                <?php if($category->thumb ): ?>
                <td><img src="<?php echo 'Media/Category/'.$category->getThumb()->name; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No thumb image</td>
                <?php endif; ?>

                <?php if($category->small ): ?>
                <td><img src="<?php echo 'Media/Category/'.$category->getSmall()->name; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No small image</td>
                <?php endif; ?>
                <td><?php echo $category->getStatus($category->status); ?></td>
                <td><?php echo $category->createdAt; ?></td>
                <td><?php echo $category->updatedAt; ?></td>
                <td><a href='<?php echo $this->getUrl('edit','category',['id'=>$category->categoryId],true) ?>'>Edit</a></td>
                <td><a href='<?php echo $this->getUrl('delete','category',['id'=>$category->categoryId],true) ?>'>Delete</a></td>
                <td><a href="<?php echo $this->getUrl('grid','category_media',['id'=>$category->categoryId],true) ?>">Gallery</a></td>
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