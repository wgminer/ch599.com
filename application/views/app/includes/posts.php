<?php if (count($posts) == 1) : ?>

	<?php if ($posts->post_source == 'youtube') : ?>

		<article id="<?php echo $posts->post_media ?>" class="post youtube">

	<?php elseif ($posts->post_source == 'soundcloud') : ?>

		<article id="<?php echo $posts->post_media ?>" class="post soundcloud">

	<?php endif; ?>

			<section class="content">

				<div class="media">

					<img src="<?php echo base_url(); ?>assets/img/placeholder.png" data-original="<?php echo $posts->post_img ?>">
		
				</div>

			</section>

			<section class="caption">

				<h2 class="title" title="<?php echo $posts->post_title ?>"><a href="<?php echo base_url(); ?>index.php/<?php echo $posts->post_slug ?>"><?php echo $posts->post_title ?></a></h2>

				<div class="meta">
					<span class="date"><i class="icon-calendar"></i><?php echo date('F j', strtotime($posts->post_created)); ?></span>
					<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?>index.php/author/<?php echo strtolower($posts->post_author); ?>"><?php echo $posts->post_author ?></a></span>
					<span class="share"><i class="icon-link"></i><a href="">Share</a></span>
				</div>

				<?php if(isset($posts->post_text)) : ?>
					<span class="comment"><i class="icon-comment"></i><?php echo $posts->post_text ?></span>
				<?php endif; ?>

			</section>

		</article>

	<?php if (isset($pagination)) : ?>

		<section id="pagination">

			<button id="load-previous" data-offset="0">Previous Posts</button>

		</section>

	<?php else : ?>

		<section id="pagination">

			<p>No More Posts</p>

		</section>

	<?php endif; ?>

<?php elseif (count($posts) > 1) : ?>

	<?php foreach ($posts as $post) : ?>

		<?php if ($post->post_source == 'youtube') : ?>

			<article id="<?php echo $post->post_media ?>" class="post youtube">

		<?php elseif ($post->post_source == 'soundcloud') : ?>

			<article id="<?php echo $post->post_media ?>" class="post soundcloud">

		<?php endif; ?>

				<section class="content">

					<div class="media">

						<img src="<?php echo base_url(); ?>assets/img/placeholder.png" data-original="<?php echo $post->post_img ?>">
			
					</div>

				</section>

				<section class="caption">

					<h2 class="title" title="<?php echo $post->post_title ?>"><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_slug ?>"><?php echo $post->post_title ?></a></h2>

					<div class="meta">
						<span class="date"><i class="icon-calendar"></i><?php echo date('F j', strtotime($post->post_created)); ?></span>
						<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?>index.php/author/<?php echo strtolower($post->post_author); ?>"><?php echo $post->post_author ?></a></span>
						<span class="share"><i class="icon-link"></i><a href="">Share</a></span>
					</div>

					<?php if(isset($post->post_text)) : ?>
						<span class="comment"><i class="icon-comment"></i><?php echo $post->post_text ?></span>
					<?php endif; ?>

				</section>

			</article>

	<?php endforeach; ?>

	<?php if (isset($pagination)) : ?>

		<section id="pagination">

			<button id="load-previous" data-offset="0">Previous Posts</button>

		</section>

	<?php else : ?>

		<section id="pagination">

			<p>No More Posts</p>

		</section>

	<?php endif; ?>

<?php else : ?>

	<div id="no-posts">
		<h1>Milagro</h1>
		<h3>No Posts!</h3>
	</div>

<?php endif; ?>

