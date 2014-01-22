<article id="<?php echo $post->post_media ?>" class="fade-in <?php if ($post->post_source == 'youtube') { echo 'youtube'; } else { echo 'soundcloud'; } ?> post playing" data-post-id="<?php echo $post->post_id ?>" data-mini-url="<?php echo $post->post_mini_url ?>" data-song-title="<?php echo $post->post_title ?>">

	<section class="media">

		<?php if ($post->post_source == 'youtube') : ?>
		
			<div id="player"></div>
			<script type="text/javascript">
				var player;
			    $(document).ready(function() {
			        player = new YT.Player('player', {
			          videoId: '<?php echo $post->post_media ?>',
			          events: {
			            'onReady': onPlayerReady,
			            'onStateChange': onPlayerStateChange
			          }
			        });
			    });

			    function onPlayerReady(event) {

			        event.target.playVideo();

			    }

			    function onPlayerStateChange(event) {
			        if (event.data == YT.PlayerState.ENDED) {

			            autoplay();

			        } else if (event.data == YT.PlayerState.PLAYING) {

			        	var songTitle = $('h2.title').text();
						$('#title').text(songTitle + ' | Channel 599');

			        } else if (event.data == YT.PlayerState.BUFFERING) {

			        	$('#title').text('Loading... | Channel 599');

			        }
			    }
			</script>

		<?php elseif ($post->post_source == 'soundcloud') : ?>

			

		<?php endif; ?>

	</section>

	<section class="social">

		<button><i class="icon-link"></i></button>
		<button><i class="icon-twitter"></i></button>
		<button><i class="icon-facebook"></i></button>
			
	</section>

	<section class="caption">

		<h2 class="title" title="<?php echo $post->post_title ?>"><?php echo $post->post_title ?></h2>

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

<section id="related" class="fade-in">
			
	<h3>Related</h3>
	<?php foreach ($relatives as $related) : ?>
			
		<a href="<?php echo base_url(); ?><?php echo $related->post_slug ?>" class="related-post">
			<div class="media">
				<img src="<?php echo $related->post_img ?>" alt="">
			</div>
			<h2><?php echo $related->post_title ?></h2>
		</a>

	<?php endforeach; ?>

</section>