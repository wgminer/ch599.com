<?php $this->load->view('admin/includes/header'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">
			
			<?php echo form_open('users/create'); ?>
				
				<label for="user_name">Name</label>
				<input class="input-block-level" type="text" name="user_name">

				<label for="user_email">Email</label>
				<input class="input-block-level" type="email" name="user_email">
				
				<label for="user_password">Password</label>
				<input class="input-block-level" type="password" name="user_password">	

<!-- 				<label for="user_photo">Photo</label>
				<input class="input-block-level" type="file" name="user_photo">	 -->		
				
				<label for="user_bio">Bio</label>
				<textarea class="input-block-level" type="text" name="user_bio" rows="10"></textarea>
			
				<input class="btn btn-block btn-primary" type="submit" value="Submit">
			
			<?php echo form_close(); ?>

		</div>


	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>