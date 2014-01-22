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

		<div id="currently-playing" class="dashed">
			<img src="" alt="">
		</div>

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

</header>

<div id="currently-playing-info" style="display:none;" class="fade-in">
	
	<span id="playing-title"></span>

	<span id="playing-time"></span>

</div>