<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h1>Settings</h1>
			
			<?php echo form_open_multipart('users/update'); ?>

				<?php if(isset($error)) : ?>
				<p class="error"><?php echo $error ?></p>
				<?php endif ?>

				<?php if(isset($success)) : ?>
				<p class="success"><?php echo $success ?></p>
				<?php endif ?>

				<input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">

				<label for="">Current Photo</label>
				<img src="<?php echo base_url(); ?>assets/img/<?php echo $user->user_photo; ?>" alt="">

				<label for="user_name">Name</label>
				<input class="input-block-level" type="text" name="user_name" value="<?php echo $user->user_name; ?>">

				<label for="user_email">Email</label>
				<input class="input-block-level" type="email" name="user_email" value="<?php echo $user->user_email; ?>">		
				
				<label for="user_photo">Photo</label>
				<input class="input-block-level" type="file" name="user_photo" value="<?php echo base_url(); ?>assets/img/<?php echo $user->user_photo; ?>">

				<label for="user_bio">Bio</label>
				<textarea class="input-block-level" type="text" name="user_bio" rows="10"><?php echo $user->user_bio; ?></textarea>
			
				<input class="btn btn-block btn-primary" type="submit" value="Save">
			
			<?php echo form_close(); ?>

		</div>


	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>