<?php 
$categories = $this->getCategories();
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Category CRUD</title>
</head>
<body>
    <div class="fluid-container m-2">
		<a href="<?php echo $this->getUrl('add','category') ?>"><button type="button" class="btn btn-primary">Add</button></a>
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
		                <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->base)['name']; ?>" alt="No Image found" width=50 height=50></td>
		                <?php else: ?>
		                <td>No base image</td>
		                <?php endif; ?>

		                <?php if($category->thumb ): ?>
		                <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->thumb)['name']; ?>" alt="No Image found" width=50 height=50></td>
		                <?php else: ?>
		                <td>No thumb image</td>
		                <?php endif; ?>

		                <?php if($category->small ): ?>
		                <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->small)['name']; ?>" alt="No Image found" width=50 height=50></td>
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
	</div>
</body>
</html>