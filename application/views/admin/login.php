<?php $this->load->view('admin/includes/header'); ?>

	<div class="container">
		
		<div class="row">
			
			<div class="span4 offset4">

				<h1 style="margin-bottom:20px;">Login</h1>
				
				<?php echo form_open('authors/validate'); ?>
		
					<?php if(isset($error)) : ?>
					<p  style="top:0;" class="error"><?php echo $error ?></p>
					<?php endif ?>

					<label for="author_name">Name</label>
					<input class="input-block-level" type="text" name="author_name" required>
					
					<label for="author_password">Password</label>
					<input class="input-block-level" type="password" name="author_password" required>

					<hr>

					<input class="btn btn-block btn-primary btn-large" type="submit" value="Login">

				<?php echo form_close(); ?>

			</div>

		</div>

	</div>

<?php $this->load->view('admin/includes/footer'); ?>