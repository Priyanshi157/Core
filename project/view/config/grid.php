<?php
$configs = $this->getConfigs();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Config</title>
</head>
<body>
	<div class="fluid-container m-2">
		<a href="<?php echo $this->getUrl('add','config',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
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
	</div>

	</body>
</html>