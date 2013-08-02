<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h1>New Post</h1>
			
			<?php echo form_open('posts/create'); ?>

				<?php if(isset($error)) : ?>
				<p class="error"><?php echo $error ?></p>
				<?php endif ?>

				<?php if(isset($success)) : ?>
				<p class="success"><?php echo $success ?></p>
				<?php endif ?>

				<input type="hidden" name="post_author" value="<?php echo $user; ?>">

				<label for="post_type">Type</label>
				<select name="post_type">
					<option value="song">Song</option>
					<option value="set">Set</option>
					<option value="text">Blog</option>
				</select>
				
				<label for="post_title">Title</label>
				<input class="input-block-level" type="text" name="post_title">

				<label for="post_media">Media</label>
				<input class="input-block-level" type="text" name="post_media">					
				
				<label for="post_text">Text</label>
				<textarea class="input-block-level" type="text" name="post_text" rows="5"></textarea>
			
				<input class="btn btn-block btn-primary" type="submit" value="Post">
			
			<?php echo form_close(); ?>

		</div>


	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>