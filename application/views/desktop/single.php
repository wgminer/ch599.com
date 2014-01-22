dDOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<title id="title"><?php echo $title ?></title>
	<meta name="description" content="<?php if (isset($post->post_text) && $post->post_text != '') { echo $post->post_text; } else { echo 'You\'re on Channel 599, a video music blog started in Rob\'s room in 2010.'; } ?>">
	<meta id="og-img" property="og:image" content="<?php echo $post->post_img ?>">

	<link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/ico">

	<?php echo link_tag(base_url().'assets/css/desktop.css'); ?>
	
	<script type="text/javascript" src="//use.typekit.net/upu6ymf.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<!--[if lt IE 9]>
		<?php echo script_tag(base_url().'assets/js/vendor/html5shiv.js'); ?>
	<![endif]-->
</head>

<body>

	<?php $this->load->view('desktop/includes/menu'); ?>
	
	<div id="wrap" class="single">

		<header id="topbar" class="fade-in">

			<section class="controls left fade-in">
				
				<button id="open-menu" title="Open Menu">
					<i class="icon-reorder"></i> Menu
				</button>

				<button id="open-search" title="Search">
					<i class="icon-search"></i> Search
				</button>

			</section>

			<h1 id="logo" title="home"><a href="<?php echo base_url(); ?>">Channel 599</a></h1>
						
			<section class="controls right fade-in">

				<button id="next-single" title="Next Song">
					<i class="icon-step-forward"></i>
				</button>

				<button id="shuffle" title="Toggle Shuffle" class="on toggle">
					Shuffle: <span>On</span>
				</button>

				<button id="lights" title="Toggle Lights" class="on toggle">
					Lights: <span>On</span>
				</button>

			</section>

		</header>
		
		<article id="<?php echo $post->post_media ?>" class="fade-in <?php if ($post->post_source == 'youtube') { echo 'youtube'; } else { echo 'soundcloud'; } ?> post playing" data-post-id="<?php echo $post->post_id ?>" data-mini-url="<?php echo $post->post_mini_url ?>" data-song-title="<?php echo $post->post_title ?>">

			<section class="media">

				<?php if ($post->post_source == 'youtube') : ?>
				
					<div id="player"></div>

				<?php elseif ($post->post_source == 'soundcloud') : ?>

					<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=<?php echo $post->post_media; ?>&auto_play=true&color=00CCCC&theme_color=00CCCC"></iframe>

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

		<?php $this->load->view('desktop/includes/footer'); ?>

	</div>
	
	<?php $this->load->view('desktop/includes/scripts'); ?>

	<script>

	    var autoplayUrl = '<?php echo base_url(); ?>autoplay';

		var player;
			
	    function onYouTubePlayerAPIReady() {

        	console.log('called onYouTubePlayerAPIReady');

	        player = new YT.Player('player', {
	          videoId: '<?php echo $post->post_media ?>',
	          events: {
	            'onReady': onPlayerReady,
	            'onStateChange': onPlayerStateEnded
	          }
	        });

	    };

        $(document).keydown(function(e){

	        if (e.keyCode == 39) { 
	           autoplay();
	        }

	    });

	</script>
	
</body>
</html>
