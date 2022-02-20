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
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
	    <div class="container-fluid">
	      	<button
		        class="navbar-toggler"
		        type="button"
		        data-mdb-toggle="collapse"
		        data-mdb-target="#navbarExample01"
		        aria-controls="navbarExample01"
		        aria-expanded="false"
		        aria-label="Toggle navigation"
		    >
	        <i class="fas fa-bars"></i>
	      	</button>
	      	<div class="collapse navbar-collapse" id="navbarExample01">
	        	<ul class="navbar-nav me-auto mb-2 mb-lg-0">
	          		<li class="nav-item active">
	            		<a class="nav-link" aria-current="page" href="#">Admin</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=category&a=grid">Category</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=product&a=grid">Product</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=customer&a=grid">Customer</a>
	          		</li>
	        	</ul>
	      	</div>
	    </div>
	</nav>


    <div class="fluid-container m-2">
		<a href="index.php?c=category&a=add"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table border my-4">
		  <thead>
		    <tr>
		      <th scope="col">Category Id</th>
		      <th scope="col">Name</th>
		      <th scope="col">Path</th>
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
					    <td><?php echo $category['categoryId']; ?></td>
					    <td><?php $result = $this->getDataByPath();
		    				echo $result[$category['categoryId']]; ?></td>
		    			<td><?php echo $category['categoryPath']; ?></td>
					    <td><?php echo $category['status']; ?></td>
					    <td><?php echo $category['createdAt']; ?></td>
					    <td><?php echo $category['updatedAt']; ?></td>
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