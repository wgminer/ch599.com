<?php $this->load->view('admin/includes/header'); ?>

	<div class="container">
		
		<div class="row">
			
			<div class="span6 offset3">

				<h1>Login</h1>
				
				<?php echo form_open('users/validate'); ?>
		
					<?php if(isset($error)) : ?>
					<p class="error"><?php echo $error ?></p>
					<?php endif ?>

					<label for="user_name">Name</label>
					<input class="input-block-level" type="text" name="user_name" required>
					
					<label for="user_password">Password</label>
					<input class="input-block-level" type="password" name="user_password" required>

					<input class="btn btn-block btn-primary" type="submit" value="Login">

				<?php echo form_close(); ?>

			</div>

		</div>

	</div>

<?php $this->load->view('admin/includes/footer'); ?>