<?php 
$this->set('action', 'Login');
$this->set('page', 'Users');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Administrar Site</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <?= $this->Html->css('styles.css') ?>

</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Administrar Site</h3>
			</div>
			<div class="card-body">
					<?= $this->Flash->render() ?>
					<?= $this->Form->create(); ?>
					
					<div class="input-group form-group">
						<div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-user"></i></span> </div>
						<input type="text" name='username' class="form-control" placeholder="username">	
					</div>
					
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name='password' class="form-control" placeholder="password">
					</div>
				
					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-success float-right login_btn">
					</div>
					<?= $this->Form->end(); ?>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>