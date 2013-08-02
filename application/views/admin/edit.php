<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h1>Edit Post</h1>
			
			<?php echo form_open('posts/update'); ?>

				<?php if(isset($error)) : ?>
				<p class="error"><?php echo $error ?></p>
				<?php endif ?>

				<?php if(isset($success)) : ?>
				<p class="success"><?php echo $success ?></p>
				<?php endif ?>

				<input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>">
				<input type="hidden" name="post_author" value="<?php echo $post->post_author; ?>">

				<label for="post_type">Type</label>
				<select name="post_type">
					<option value="song" <?php if ($post->post_type == 'song') { print 'selected'; } ?>>Song</option>
					<option value="set" <?php if ($post->post_type == 'set') { print 'selected';} ?>>Set</option>
					<option value="text" <?php if ($post->post_type == 'text') { print 'selected'; } ?>>Blog</option>
				</select>
				
				<label for="post_title">Title</label>
				<input class="input-block-level" type="text" name="post_title" value="<?php echo $post->post_title; ?>">

				<img src="http://img.youtube.com/vi/<?php echo $post->post_media; ?>/hqdefault.jpg">
				<input class="input-block-level" type="text" name="post_media" value="http://youtube.com/watch?v=<?php echo $post->post_media; ?>">					
				
				<label for="post_text">Text</label>
				<textarea class="input-block-level" type="text" name="post_text" rows="5"><?php echo $post->post_text; ?></textarea>
			
				<input class="btn btn-block btn-primary" type="submit" value="Update">
			
			<?php echo form_close(); ?>

		</div>


	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>