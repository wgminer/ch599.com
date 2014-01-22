<?php $this->load->view('admin/includes/header'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">
			
			<?php echo form_open('authors/create'); ?>
				
				<label for="author_name">Name</label>
				<input class="input-block-level" type="text" name="author_name">

				<label for="author_email">Email</label>
				<input class="input-block-level" type="email" name="author_email">
				
				<label for="author_password">Password</label>
				<input class="input-block-level" type="password" name="author_password">	

<!-- 				<label for="author_photo">Photo</label>
				<input class="input-block-level" type="file" name="author_photo">	 -->		
				
				<label for="author_bio">Bio</label>
				<textarea class="input-block-level" type="text" name="author_bio" rows="10"></textarea>
			
				<input class="btn btn-block btn-primary" type="submit" value="Submit">
			
			<?php echo form_close(); ?>

		</div>


	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>