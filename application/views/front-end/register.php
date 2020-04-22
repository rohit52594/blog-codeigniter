

	<!--/banner-->
	<div class="banner-inner">
	</div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?php echo site_url('/') ?>">Home</a>
		</li>
		<li class="breadcrumb-item active">Register</li>
	</ol>
	<!--//banner-->
	<!--/main-->
	<section class="main-content-w3layouts-agileits">
		<div class="container">
				<h3 class="tittle">Register now</h3>
				<div class="row inner-sec">
					<div class="login p-5 bg-light mx-auto mw-100">
			
			<?php
				if ($this->session->flashdata('message')) {
					echo '<div class = "alert alert-success">' . $this->session->flashdata('message') .'</div>';
				}
			?>
				<form action="<?php echo site_url('account/registerer'); ?>" method="post">
						<div class="form-group">
								<label>Name</label>

								<input type="text" class="form-control" name = "user_name" value = "<?php echo set_value('user_name'); ?>" placeholder="Enter your name">
								<span class = "text-danger"><?php echo form_error('user_name'); ?></span>
						</div>

						<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" placeholder="Enter your email" name = "email" value = "<?php echo set_value('email'); ?>">
								<span class = "text-danger"><?php echo form_error('email'); ?></span>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" placeholder="Enter a secure password" name = "password" value = "<?php echo set_value('password'); ?>">

							<span class = "text-danger"><?php echo form_error('password'); ?></span>
						</div>
							<button type="submit" class="btn btn-primary submit mb-4">Register</button>
						</form>
		
					</div>
			</div>
		</div>
	</section>
	<!--//main-->