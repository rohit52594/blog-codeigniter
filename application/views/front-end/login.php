

	<!--/banner-->
	<div class="banner-inner">
	</div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?php echo site_url('/') ?>">Home</a>
		</li>
		<li class="breadcrumb-item active">Signin</li>
	</ol>
	<!--//banner-->
	<!--/main-->
	<section class="main-content-w3layouts-agileits">
		<div class="container">
				<h3 class="tittle">Sign In Now</h3>
				<div class="row inner-sec">
					<div class="login p-5 bg-light mx-auto mw-100">

					<?php
						if ($this->session->flashdata('message')) {
							echo '<div class = "alert alert-danger">' . $this->session->flashdata('message') .'</div>';
						}
					?>
					<form method="post" action = "<?php echo site_url('account/processLogin'); ?>">
							<div class="form-group">
							  <label>Email address</label>
							  <input type="email" class="form-control" placeholder = "Enter your email" name = "email" value = "<?php echo set_value('email'); ?>">
							  <span class = "text-error"><?php echo form_error('email'); ?></span>
							  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
							<div class="form-group">
							  <label>Password</label>
							  <input type="password" name = "password" class="form-control" value = "<?php echo set_value('password'); ?>" placeholder="Enter your password">
							  <span class = "text-error"><?php echo form_error('password'); ?></span>
							</div>
							<div class="form-check mb-2">
							  <input type="checkbox" class="form-check-input" id="exampleCheck1">
							  <label class="form-check-label" for="exampleCheck1">Check me out</label>
							</div>
							<button name = "login" type="submit" class="btn btn-primary submit mb-4">Sign In</button>
							<p><a href="<?php echo site_url('account/register') ?>"> Don't have an account?</a></p>
						  </form>
		</div>
		</div>
	</div>
	</section>
	<!--//main-->