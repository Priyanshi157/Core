<?php
$pages = $this->getPages();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>page</title>
</head>
<body>
	<div class="fluid-container m-2">
		<a href="<?php echo $this->getUrl('add','page',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table border my-4">
		  <thead>
		    <tr>
		      <th scope="col">Page Id</th>
		      <th scope="col">Name</th>
		      <th scope="col">Code</th>
		      <th scope="col">Content</th>
		      <th scope="col">Status</th>
		      <th scope="col">Created At</th>
		      <th scope="col">Updated At</th>
		      <th scope="col">Edit</th>
		      <th scope="col">Delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(!$pages): ?>
		  		<tr><td colspan="10">No Record available.</td></tr>
		  	<?php else: ?>
		  		<?php foreach ($pages as $page): ?>
			  		<tr>
					    <td><?php echo $page->pageId ?></td>
					    <td><?php echo $page->name ?></td>
					    <td><?php echo $page->code ?></td>
					    <td><?php echo $page->content ?></td>
					    <td><?php echo $page->getStatus($page->status) ?></td>
					    <td><?php echo $page->createdAt ?></td>
					    <td><?php echo $page->updatedAt ?></td>
					    <td><a href="<?php echo $this->getUrl('edit','page',['id'=>$page->pageId],true); ?>">Edit</a></td>
					    <td><a href="<?php echo $this->getUrl('delete','page',['id'=>$page->pageId],true); ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
	</div>

	</body>
</html>