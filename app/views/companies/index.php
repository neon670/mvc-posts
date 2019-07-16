<?php require APPROOT . '/views/includes/header.php';?>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		
	</div>
</div>

<?php foreach($data['company'] as $company) :?>
		<div class="card card-body mb-3">
			<h4 class="card-title"><?php echo $company->company_name ;?></h4>
			<div class="bg-light p-2 mb-3">
				 <?php echo $company->address;?>
				 <?php echo $company->city;?>
				 <?php echo $company->country;?>
			</div>
			<p class="card-text">Office Contact</p>
			<p class="card-text"><?php echo $company->name;?></p>
			<p class="card-text"><?php echo $company->email;?></p>
		</div>
<?php endforeach;?>
<?php require APPROOT . '/views/includes/footer.php';?>