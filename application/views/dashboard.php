<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Curd Operation</title>
	<link rel="stylesheet" href="<?= base_url().'assets/css/bootstrap.min.css'?>">
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.min.js';?>"></script>
	<script type="text/javascript" src="<?= base_url().'assets/js/bootstrap.min.js'?>"></script>
	<script type="text/javascript">	<?php include('jscript.php');?></script>
</head>
<body>
	<div class="container">
		<marquee behavior="alternative" direction="left"><h5><b>AB UTNAL, Email:</b> utnal.ab@gmail.com</h5></marquee>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
					<div id="message"></div>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<div id="result"></div>	
						
				<div class="panel panel-primary" id="insert_form">
					<div class="panel-heading">Profile Form</div>
					<div class="panel-body">
						<div class="row">
							<form action="<?= base_url('admin/create')?>" method="POST" id="insertForm" enctype="multipart/form-data">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" value="" name="name" placeholder="Name" id="input-name"class="form-control  is-invalid">
										<div class="error"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" value="" name="phone" placeholder="phone" id="input-phone"class="form-control">
										<div class="error"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" value="" name="email" placeholder="Email" id="input-email" class="form-control">
										<div class="error"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									<input type="file" value="" name="photo" placeholder="" id="input-photo" class="form-control">
									<div class="error"></div>
									</div>
								</div>
								<div class="col-md-12"><input type="submit" name="submit"  id="" class="btn btn-primary pull-right"></div>
							</form>
						</div>
					</div>
				</div>
			
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered  table-inverse" id="dataTable">
				</table>
			</div>
		</div>
	</div>
</body>
</html>