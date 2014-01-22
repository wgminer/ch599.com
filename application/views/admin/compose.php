<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h3>1 of 3: Compose Post</h3>

			<div class="well">
			
				<?php echo form_open('posts/create'); ?>

					<?php if(isset($error)) : ?>
					<p class="error"><?php echo $error ?></p>
					<?php endif ?>

					<?php if(isset($success)) : ?>
					<p class="success"><?php echo $success ?></p>
					<?php endif ?>

					<input type="hidden" name="post_author" value="<?php echo $author; ?>">
					
					<label for="post_title">Title</label>
					<input class="input-block-level" type="text" name="post_title">

					<label for="post_media">Media</label>
					<img id="media_preview" src="http://img.youtube.com/vi//hqdefault.jpg">
					<input id="post_media" class="input-block-level" type="text" name="post_media">					
					
					<label for="post_text">Text</label>
					<textarea class="input-block-level" type="text" name="post_text" rows="5"></textarea>

					<label for="post_genre">Genre</label>
					<select name="post_genre">
						<option value="">Select One</option>
						<?php foreach ($genres as $genre) : ?>
							<option value="<?php echo $genre->genre_id; ?>"><?php echo $genre->genre_name; ?></option>
						<?php endforeach; ?>
					</select>
					<a style="line-height:30px; margin-left:15px;" href="http://www.beatport.com/" target="_blank">Check Beatport</a>
<!-- 					<hr>

					<label for="post_type">Type</label>
					<select name="post_type">
						<option value="song">Song</option>
						<option value="set">Set</option>
						<option value="text">Blog</option>
					</select> -->

					<label for="post_status">Status</label>
					<select name="post_status">
						<option value="published">Published</option>
						<option value="draft">Draft</option>
					</select>

					<hr>
				
					<input class="btn btn-block btn-primary btn-large" type="submit" value="Create Post">
				
				<?php echo form_close(); ?>

			</div>

		</div>

	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>