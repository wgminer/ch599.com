<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h3>Edit Post</h3>

			<div class="well">

				<?php echo form_open('posts/update'); ?>

					<input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>">
					<input type="hidden" name="post_author" value="<?php echo $post->post_author_id; ?>">
					
					<label for="post_title">Title</label>
					<input class="input-block-level" type="text" name="post_title" value="<?php echo $post->post_title; ?>">
					
					<label for="post_media">Media</label>	
					<img id="media_preview" src="<?php echo $post->post_img; ?>">

					<?php if ($post->post_source == 'youtube') : ?>

						<input id="post_media" class="input-block-level" type="text" name="post_media" value="http://youtube.com/watch?v=<?php echo $post->post_media; ?>">			

					<?php elseif ($post->post_source == 'soundcloud') : ?>

						<input id="post_media" class="input-block-level" type="text" name="post_media" value="<?php echo $post->post_media; ?>">	

					<?php endif; ?>

					<label for="post_text">Text</label>
					<textarea class="input-block-level" type="text" name="post_text" rows="5"><?php echo $post->post_text; ?></textarea>

					<label for="post_genre">Genre</label>
					<select name="post_genre">
						<option value="">Select One</option>
						<?php foreach ($genres as $genre) : ?>
							<option value="<?php echo $genre->genre_id; ?>" <?php if ($post->post_genre_id == $genre->genre_id) { print 'selected'; } ?>><?php echo $genre->genre_name; ?></option>
						<?php endforeach; ?>
					</select>
					<a style="line-height:30px; margin-left:15px;" href="http://www.beatport.com/" target="_blank">Check Beatport</a>
					<hr>
<!-- 
					<label for="post_type">Type</label>
					<select name="post_type">
						<option value="song" <?php if ($post->post_type == 'song') { print 'selected'; } ?>>Song</option>
						<option value="set" <?php if ($post->post_type == 'set') { print 'selected';} ?>>Set</option>
						<option value="text" <?php if ($post->post_type == 'text') { print 'selected'; } ?>>Blog</option>
					</select> -->

					<label for="post_type">Status</label>
					<select name="post_status">
						<option value="published" <?php if ($post->post_status == 'published') { print 'selected'; } ?>>Published</option>
						<option value="draft" <?php if ($post->post_status == 'draft') { print 'selected';} ?>>Draft</option>
						<option value="error" <?php if ($post->post_status == 'error') { print 'selected';} ?>>Error</option>
					</select>
					<hr>
					
					<a href="<?php echo base_url(); ?>tweet?id=<?php echo $post->post_id; ?>&fb=false" class="btn"><i class="icon-twitter"></i> Tweet Song</a>
					<a href="<?php echo base_url(); ?>facebook?id=<?php echo $post->post_id; ?>" class="btn"><i class="icon-facebook"></i> Facebook Song</a>

					<hr>
				
					<input class="btn btn-block btn-primary btn-large" type="submit" value="Update Post">
				
				<?php echo form_close(); ?>

			</div>

		</div>

	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>