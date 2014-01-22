<?php if (count($posts) == 1) :

	$post = $posts; ?>

	<article id="<?php echo $post->post_media ?>" class="<?php if ($post->post_source == 'youtube') { echo 'youtube'; } else { echo 'soundcloud'; } ?> post" data-mini-url="<?php echo $post->post_mini_url ?>" data-song-title="<?php echo $post->post_title ?>">

		<section class="media">

			<img src="<?php echo base_url(); ?>assets/img/placeholder.png" data-original="<?php echo $post->post_img ?>">

		</section>

		<section class="social">

			<button><i class="icon-link"></i></button>
			<button><i class="icon-twitter"></i></button>
			<button><i class="icon-facebook"></i></button>
				
		</section>

		<section class="caption">

			<h2 class="title" title="<?php echo $post->post_title ?>"><a href="<?php echo base_url(); ?><?php echo $post->post_slug ?>"><?php echo $post->post_title ?></a></h2>

			<div class="meta">
				<span class="date"><i class="icon-calendar"></i>
					<?php if (date('Y', strtotime($post->post_created)) != date('Y')) : ?>
						<?php echo date('M j Y', strtotime($post->post_created)); ?>
					<?php else : ?>
						<?php echo date('M j', strtotime($post->post_created)); ?>
					<?php endif; ?>
				</span>
				<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?><?php echo $post->post_author_slug; ?>"><?php echo $post->post_author ?></a></span>
				<?php if(isset($post->post_genre) && $post->post_genre != '') : ?>
					<span class="genre"><i class="icon-music"></i><a href="<?php echo base_url(); ?><?php echo $post->post_genre_slug; ?>"><?php echo $post->post_genre ?></a></span>
				<?php endif; ?>
			</div>

			<?php if(isset($post->post_text) && $post->post_text != '') : ?>
				<span class="comment"><i class="icon-comment"></i><?php echo $post->post_text ?></span>
			<?php endif; ?>

		</section>

	</article>

<?php elseif (count($posts) > 1) :

	foreach ($posts as $post) : ?>

	<article id="<?php echo $post->post_media ?>" class="<?php if ($post->post_source == 'youtube') { echo 'youtube'; } else { echo 'soundcloud'; } ?> post" data-mini-url="<?php echo $post->post_mini_url ?>" data-song-title="<?php echo $post->post_title ?>">

		<section class="media">

			<img src="<?php echo base_url(); ?>assets/img/placeholder.png" data-original="<?php echo $post->post_img ?>">

		</section>

		<section class="social">

			<button title="Permalink"><i class="icon-link"></i></button>
			<button title="Share on Twitter"><i class="icon-twitter"></i></button>
			<button title="Share on Facebook"><i class="icon-facebook"></i></button>
				
		</section>

		<section class="caption">

			<h2 class="title" title="<?php echo $post->post_title ?>"><a href="<?php echo base_url(); ?><?php echo $post->post_slug ?>"><?php echo $post->post_title ?></a></h2>

			<div class="meta">
				<span class="date"><i class="icon-calendar"></i>
					<?php if (date('Y', strtotime($post->post_created)) != date('Y')) : ?>
						<?php echo date('M j Y', strtotime($post->post_created)); ?>
					<?php else : ?>
						<?php echo date('M j', strtotime($post->post_created)); ?>
					<?php endif; ?>
				</span>
				<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?><?php echo $post->post_author_slug; ?>"><?php echo $post->post_author ?></a></span>
				<?php if(isset($post->post_genre) && $post->post_genre != '') : ?>
					<span class="genre"><i class="icon-music"></i><a href="<?php echo base_url(); ?><?php echo $post->post_genre_slug; ?>"><?php echo $post->post_genre ?></a></span>
				<?php endif; ?>
			</div>

			<?php if(isset($post->post_text) && $post->post_text != '') : ?>
				<span class="comment"><i class="icon-comment"></i><?php echo $post->post_text ?></span>
			<?php endif; ?>

		</section>

	</article>

	<?php endforeach; ?>

	<?php if (isset($pagination)) : ?>

		<section id="pagination">

			<button id="previous-posts" data-offset="<?php echo $offset ?>">Previous Posts</button>

		</section>

	<?php endif; ?>

<?php else : ?>

	<div id="no-posts">
		
		<h2>Milagro!</h2>
		<p>We didn't find anything...</p>

	</div>

<?php endif; ?>