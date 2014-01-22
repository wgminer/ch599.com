<?php $this->load->view('mobile/includes/head'); ?>

<body>

	<?php $this->load->view('mobile/includes/topbar'); ?>

	<section id="single">

		<article id="<?php echo $post->post_media ?>" class="<?php if ($post->post_source == 'youtube') { echo 'youtube'; } else { echo 'soundcloud'; } ?> post" data-mini-url="<?php echo $post->post_mini_url ?>" data-song-title="<?php echo $post->post_title ?>">

			<section class="media">

				<iframe src="http://www.youtube.com/embed/<?php echo $post->post_media ?>?html5=1"></iframe>

			</section>

			<section class="caption">

				<h2 class="title" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></h2>

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

			<a class="share" target="_blank" href="http://mobile.twitter.com/home?status=Listening%20to%20<?php echo $post->post_title; ?>%20on%20@channel599%20ch599.com/<?php echo $post->post_mini_url; ?>"><i class="icon-twitter"></i>Tweet</a>

			<a class="share" target="_blank" href="http://m.facebook.com/sharer.php?u=ch599.com/<?php echo $post->post_slug; ?>"><i class="icon-facebook"></i>Share on Facebook</a>

		</article>	

	</section>

	<?php $this->load->view('mobile/includes/scripts'); ?>

	
</body>
</html>