<?php require APPROOT . '/views/includes/header.php';?>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1><?php echo $data['title'];?></h1>
		<p class="lead"><?php echo $data['description'];?></p>
	</div>
</div>

<div class="search-box">
	<?php include ('search.php');?>
</div>

<?php require APPROOT . '/views/includes/footer.php';?>