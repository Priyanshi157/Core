<?php
require_once("Model/Core/Adapter.php");
$adapter = new Model_Core_Adapter();
$categories = $adapter->fetchAll("SELECT * FROM category");
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
		<a href="index.php?c=category&a=add"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table border my-4">
		  <thead>
		    <tr>
		      <th scope="col">Category Id</th>
		      <th scope="col">Name</th>
		      <th scope="col">Status</th>
		      <th scope="col">CreatedAt</th>
		      <th scope="col">UpdatedAt</th>
		      <th scope="col">Edit</th>
		      <th scope="col">Delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(!$categories): ?>
		  		<tr><td colspan="10">No Record available.</td></tr>
		  	<?php else: ?>
		  		<?php foreach ($categories as $category): ?>
			  		<tr>
					    <td><?php echo $category['categoryId'] ?></td>
					    <td><?php echo $category['name'] ?></td>
					    <td><?php echo $category['status'] ?></td>
					    <td><?php echo $category['createdAt'] ?></td>
					    <td><?php echo $category['updatedAt'] ?></td>
					    <td><a href="index.php?c=category&a=edit&id=<?php echo $category['categoryId'] ?>">Edit</a></td>
						<td><a href="index.php?c=category&a=delete&id=<?php echo $category['categoryId'] ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
	</div>

	</body>
</html>