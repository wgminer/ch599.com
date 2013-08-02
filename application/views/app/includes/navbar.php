<header id="header">

	<section class="controls">
		
		<button id="open-menu" title="Open Menu">
			<i class="icon-reorder"></i>
			Menu
		</button>

	</section>

	<h1 id="logo" title="home"><a href="<?php echo base_url(); ?>">Channel 599</a></h1>
	
	<?php if ($controls) : ?>
	
		<section class="controls">

			<!-- Flipped because of float:right; -->

			<button id="next" title="Next Song">
				<i class="icon-step-forward"></i>
			</button>

			<button id="play" title="Play/Pause Song">
				<i class="icon-play"></i>
			</button>

			<button id="prev" title="Previous Song">
				<i class="icon-step-backward"></i>
			</button>

		</section>

	<?php endif; ?>

	<?php if ($autoplay) : ?>
	
		<section class="controls">

			<button id="next" title="Next Song">
				<i class="icon-step-forward"></i>
			</button>

			<button id="open-autoplay" title="Open Autoplay">
				Autoplay: On
			</button>

		</section>

	<?php endif; ?>



</header>