<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">

	<div class="row">
		<div class="span12">
	
			<section id="profile">
				<img src="<?php echo base_url(); ?>assets/img/<?php echo $author->author_photo; ?>" alt="">
				<h2 id="name"><?php echo $author->author_name; ?></h2>
				<p id="bio"><?php echo $author->author_bio; ?></p>
			</section>

		</div>
	</div>
	
	<div class="row">
		
		<div class="span6">

			<h3>Settings</h3>
			
			<div class="well">
				<?php echo form_open_multipart('authors/update'); ?>

					<input type="hidden" name="author_id" value="<?php echo $author->author_id; ?>">

					<label for="author_name">Name</label>
					<input class="input-block-level" type="text" name="author_name" value="<?php echo $author->author_name; ?>">

					<label for="author_email">Email</label>
					<input class="input-block-level" type="email" name="author_email" value="<?php echo $author->author_email; ?>">		

					<label for="author_bio">Bio</label>
					<textarea id="author_bio" class="input-block-level" type="text" name="author_bio" rows="5"><?php echo $author->author_bio; ?></textarea>

					<hr>
				
					<input class="btn btn-block btn-primary btn-large" type="submit" value="Save Settings">
				
				<?php echo form_close(); ?>
			</div>
		</div>

		<div class="span6">

			<h3>Photo</h3>
			<div class="well">
				<ol>
					<li>Photo must be square</li>
					<li>Max dimensions are 500 x 500 px</li>
					<li>Max size is 1mb</li>
				</ol>
				<?php echo form_open_multipart('authors/photo'); ?>

					<input type="hidden" name="author_id" value="<?php echo $author->author_id; ?>">	
					
					<input style="margin-bottom: 20px" class="input-block-level" type="file" name="author_photo" value="<?php echo base_url(); ?>assets/img/<?php echo $author->author_photo; ?>">

					<hr>
				
					<input class="btn btn-block btn-primary btn-large" type="submit" value="Upload Photo">
				
				<?php echo form_close(); ?>
			</div>
			
			<h3>Password</h3>
			<div class="well">
				<?php echo form_open_multipart('authors/password'); ?>

					<input type="hidden" name="author_id" value="<?php echo $author->author_id; ?>">

					<label for="author_old_password">Old Password</label>
					<input class="input-block-level" type="password" name="author_old_password">	

					<label for="author_new_password">New Password</label>
					<input class="input-block-level" type="password" name="author_new_password">

					<hr>
				
					<input class="btn btn-block btn-primary btn-large" type="submit" value="Update Password">
				
				<?php echo form_close(); ?>
			</div>


		</div>


	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>