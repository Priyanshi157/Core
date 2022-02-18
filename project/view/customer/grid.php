<?php
$customer = $this->getData('customers');
$selectAddress = $this->getData('address');
//echo "<pre>";
//print_r($selectAddress);
//exit;
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Customer</title>
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
		<a href="index.php?c=customer&a=add"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table table-bordered my-4">
		  <thead>
		    <tr>
		      <th scope="col">customer Id</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Mobile</th>
		      <th scope="col">Status</th>
		      <th scope="col">Created At</th>
		      <th scope="col">Updated AT</th>
		      <th scope="col">Address</th>
		      <th scope="col">Edit</th>
		      <th scope="col">Delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(!$customer): ?>
		  		<tr><td colspan="10">No Record available.</td></tr>
		  	<?php else: ?>
		  		<?php foreach ($customer as $key => $value): ?>
			  		<tr>
					    <td><?php echo $customer[$key]['customerId'] ?></td>
					    <td><?php echo $customer[$key]['firstName'] ?></td>
					    <td><?php echo $customer[$key]['lastName'] ?></td>
					    <td><?php echo $customer[$key]['email'] ?></td>
					    <td><?php echo $customer[$key]['mobile'] ?></td>
					    <td><?php echo $customer[$key]['status'] ?></td>
					    <td><?php echo $customer[$key]['createdAt'] ?></td>
					    <td><?php echo $customer[$key]['updatedAt'] ?></td>
					    <td><?php echo $selectAddress[$key]['address'] ?></td>
						<td><a href="index.php?c=customer&a=edit&id=<?php echo $customer[$key]['customerId'] ?>">Edit</a></td>
						<td><a href="index.php?c=customer&a=delete&id=<?php echo $customer[$key]['customerId'] ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
	</div>

</body>
</html>