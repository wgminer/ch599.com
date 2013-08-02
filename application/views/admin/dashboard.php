<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
			
		<div class="span12">
			
			<h1>Dashboard</h1>

			<table class="table table-bordered">

				<tr>
					<th width="2%">#</th>
					<th width="5%">Video</th>
					<th width="30%">Title</th>
					<th>Text</th>
					<th width="15%"></th>
				</tr>

				<?php if (isset($posts)) : ?>

					<?php if (sizeof($posts) <= 1) : ?>

						<?php if ($post->post_source == 'youtube') : ?>

							<tr>
								<td><?php echo $post->post_id ?></td>
								<td><img src="<?php echo $post->post_img; ?>"></td>
								<td><a href="<?php echo base_url(); ?>index.php/post/<?php echo $post->post_slug; ?>" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a></td>
								<td><?php echo $post->post_text ?></td>
								<td>
									<a href="<?php echo base_url(); ?>index.php/posts/edit/<?php echo $post->post_id; ?>" class="btn btn-small btn-primary">Edit</a>
									<a href="<?php echo base_url(); ?>index.php/posts/delete/<?php echo $post->post_id; ?>" class="btn btn-small btn-danger">Delete</a>
								</td>
							</tr>

						<?php elseif ($post->post_source == 'soundcloud') : ?>

							<tr>
								<td><?php echo $post->post_id ?></td>
								<td><img src="<?php echo str_replace('t500x500', 'small', $post->post_img); ?>"></td>
								<td><a href="<?php echo base_url(); ?>index.php/post/<?php echo $post->post_slug; ?>" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a></td>
								<td><?php echo $post->post_text ?></td>
								<td>
									<a href="<?php echo base_url(); ?>index.php/posts/edit/<?php echo $post->post_id; ?>" class="btn btn-small btn-primary">Edit</a>
									<a href="<?php echo base_url(); ?>index.php/posts/delete/<?php echo $post->post_id; ?>" class="btn btn-small btn-danger">Delete</a>
								</td>
							</tr>

						<?php endif; ?>

					<?php else : ?>

						<?php foreach ($posts as $post) : ?>

							<?php if ($post->post_source == 'youtube') : ?>

								<tr>
									<td><?php echo $post->post_id ?></td>
									<td><img src="<?php echo $post->post_img; ?>"></td>
									<td><a href="<?php echo base_url(); ?>index.php/post/<?php echo $post->post_slug; ?>" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a></td>
									<td><?php echo $post->post_text ?></td>
									<td>
										<a href="<?php echo base_url(); ?>index.php/posts/edit/<?php echo $post->post_id; ?>" class="btn btn-small btn-primary">Edit</a>
										<a href="<?php echo base_url(); ?>index.php/posts/delete/<?php echo $post->post_id; ?>" class="btn btn-small btn-danger">Delete</a>
									</td>
								</tr>

							<?php elseif ($post->post_source == 'soundcloud') : ?>

								<tr>
									<td><?php echo $post->post_id ?></td>
									<td><img src="<?php echo str_replace('t500x500', 'large', $post->post_img); ?>"></td>
									<td><a href="<?php echo base_url(); ?>index.php/post/<?php echo $post->post_slug; ?>" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></a></td>
									<td><?php echo $post->post_text ?></td>
									<td>
										<a href="<?php echo base_url(); ?>index.php/posts/edit/<?php echo $post->post_id; ?>" class="btn btn-small btn-primary">Edit</a>
										<a href="<?php echo base_url(); ?>index.php/posts/delete/<?php echo $post->post_id; ?>" class="btn btn-small btn-danger">Delete</a>
									</td>
								</tr>

							<?php endif; ?>

						<?php endforeach; ?>

					<?php endif; ?>

				<?php endif; ?>
		
			</table>

		</div>

	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>