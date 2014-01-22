<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">

	<div class="row">
			
		<div class="span12">

			<h3 class="error-report" style="display:none;">Errors</h3>

			<table id="error-report" class="table table-bordered error-report" style="display:none;">

				<thead>
					<tr>
						<th width="5%">Video</th>
						<th width="20%">Title</th>
						<th width="10%">Date</th>
						<th width="10%">Genre</th>
						<th>Text</th>
						<th style="min-width:194px"></th>
					</tr>
				</thead>
				
				<tbody>

					<?php foreach ($posts as $post) : ?>

						<?php if ($post->post_status == 'error') : ?>

							<tr id="<?php echo $post->post_id; ?>" data-delete-url="<?php echo base_url(); ?>delete/<?php echo $post->post_id; ?>">
								<td><img src="<?php if ($post->post_source == 'youtube') { echo $post->post_img; } else { echo str_replace('t500x500', 'large', $post->post_img); } ?>"></td>
								<td><a href="<?php echo base_url(); ?><?php echo $post->post_slug; ?>" target="_blank" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a></td>
								<td><?php echo date('F j', strtotime($post->post_created)); ?></td>
								<td><?php if (isset($post->post_genre)) { echo $post->post_genre; } ?></td>
								<td><?php echo $post->post_text ?></td>
								<td>
									<a href="#genre-modal" data-toggle="modal" class="btn btn-small btn-info btn-genre">Quick Genre</a>
									<a href="<?php echo base_url(); ?>edit/<?php echo $post->post_id; ?>" class="btn btn-small btn-primary">Edit</a>
									<a href="#delete-modal" data-toggle="modal" class="btn btn-small btn-danger btn-delete">Delete</a>
								</td>
							</tr>

						<?php endif; ?>

					<?php endforeach; ?>
				
				</tbody>
			
			</table>
			
			<h3>Posts</h3>

			<table class="table table-bordered">

				<thead>
					<tr>
						<th width="5%">Video</th>
						<th width="20%">Title</th>
						<th width="10%">Date</th>
						<th width="10%">Genre</th>
						<th>Text</th>
						<th style="min-width:194px"></th>
					</tr>
				</thead>

				<?php foreach ($posts as $post) : ?>

					<?php if ($post->post_status != 'error') : ?>

						<tr id="<?php echo $post->post_id; ?>" data-delete-url="<?php echo base_url(); ?>delete/<?php echo $post->post_id; ?>">
							<td><img src="<?php if ($post->post_source == 'youtube') { echo $post->post_img; } else { echo str_replace('t500x500', 'large', $post->post_img); } ?>"></td>
							<td><a href="<?php echo base_url(); ?><?php echo $post->post_slug; ?>" target="_blank" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a></td>
							<td><?php echo date('F j', strtotime($post->post_created)); ?></td>
							<td class="genre-td"><?php if (isset($post->post_genre)) { echo $post->post_genre; } ?></td>
							<td><?php echo $post->post_text ?></td>
							<td>
								<a href="#genre-modal" data-toggle="modal" class="btn btn-small btn-info btn-genre">Quick Genre</a>
								<a href="<?php echo base_url(); ?>edit/<?php echo $post->post_id; ?>" class="btn btn-small btn-primary">Edit</a>
								<a href="#delete-modal" data-toggle="modal" class="btn btn-small btn-danger btn-delete">Delete</a>
							</td>
						</tr>

					<?php endif; ?>

				<?php endforeach; ?>
		
			</table>

		</div>

	</div>

</div>

<div id="delete-modal" class="modal hide fade in">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3 id="myModalLabel">Sure you want to delete this post?</h3>
  	</div>
  	<div class="modal-body">
    	<a id="confirm-delete" href="" class="btn btn-danger btn-block btn-large">Yup, Delete It</a>
  	</div>
</div>

<div id="genre-modal" class="modal hide fade in">
  	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3 id="myModalLabel">Add a genre</h3>
  	</div>
  	<div class="modal-body">
    	<?php echo form_open('posts/update_genre'); ?>

    		<input id="genre-post-id" name="post_id" type="hidden" value="">

			<label for="post_genre">Genre</label>
			<select name="post_genre">
				<option value="">Select One</option>
				<?php foreach ($genres as $genre) : ?>
					<option value="<?php echo $genre->genre_id; ?>" <?php if ($post->post_genre_id == $genre->genre_id) { print 'selected'; } ?>><?php echo $genre->genre_name; ?></option>
				<?php endforeach; ?>
			</select>
			<a style="line-height:30px; margin-left:15px;" href="http://www.beatport.com/" target="_blank">Check Beatport</a>
			<hr>
		
			<input class="btn btn-block btn-primary btn-large" type="submit" value="Update Genre">
		
		<?php echo form_close(); ?>
  	</div>
</div>

<?php $this->load->view('admin/includes/footer'); ?>

<script>
	
	$('img').error(function(){
		alert($(this).attr('src'));
	});

</script>