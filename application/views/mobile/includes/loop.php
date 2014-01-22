<?php if (count($posts) == 1) :

	$post = $posts; ?>

		<article id="<?php echo $post->post_media ?>" class="<?php if ($post->post_source == 'youtube') { echo 'youtube'; } else { echo 'soundcloud'; } ?> post" data-mini-url="<?php echo $post->post_mini_url ?>" data-song-title="<?php echo $post->post_title ?>">

			<section class="media">

				<iframe src="http://www.youtube.com/embed/<?php echo $post->post_media ?>?html5=1"></iframe>

			</section>

			<section class="caption">

				<h2 class="title" title="<?php echo $post->post_title ?>"><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_slug ?>"><?php echo $post->post_title ?></a></h2>

				<div class="meta">
					<span class="date"><i class="icon-calendar"></i><?php echo date('F j', strtotime($post->post_created)); ?></span>
					<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_author_slug; ?>"><?php echo $post->post_author ?></a></span>
					<?php if(isset($post->post_genre) && $post->post_genre != '') : ?>
						<span class="genre"><i class="icon-music"></i><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_genre_slug; ?>"><?php echo $post->post_genre ?></a></span>
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

				<iframe src="http://www.youtube.com/embed/<?php echo $post->post_media ?>?html5=1"></iframe>

			</section>

			<section class="caption">

				<h2 class="title" title="<?php echo $post->post_title ?>"><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_slug ?>"><?php echo $post->post_title ?></a></h2>

				<div class="meta">
					<span class="date"><i class="icon-calendar"></i><?php echo date('F j', strtotime($post->post_created)); ?></span>
					<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_author_slug; ?>"><?php echo $post->post_author ?></a></span>
					<?php if(isset($post->post_genre) && $post->post_genre != '') : ?>
						<span class="genre"><i class="icon-music"></i><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_genre_slug; ?>"><?php echo $post->post_genre ?></a></span>
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

			<button id="previous-posts" data-offset="<?php echo $offset ?>">Load More Posts</button>

		</section>

	<?php endif; ?>

<?php else : ?>

	<div id="no-posts">
		
		<h2>Milagro!</h2>
		<p>We didn't find anything...</p>

	</div>

<?php endif; ?>