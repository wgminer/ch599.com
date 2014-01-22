<header id="topbar">

	<h1 id="logo" title="home"><a href="<?php echo base_url(); ?>">Channel 599</a></h1>

	<button id="open-menu" title="Open Menu" onclick="toggle_visibility('menu');">
		<i class="icon-reorder"></i>
	</button>

<!-- 	<button id="open-search" title="Open Menu">
		<i class="icon-search"></i>
	</button> -->

</header>

<section id="menu" style="display:none;">
	
	<h3>Authors</h3>
	<ul class="two-col">
		<?php foreach ($authors as $author) : ?>
			<li><a href="<?php echo base_url(); ?>index.php/<?php echo $author->author_slug; ?>"><?php echo $author->author_name; ?></a></li>
		<?php endforeach; ?>
	</ul>

	<h3>Genres</h3>
	<ul class="two-col">
		<?php foreach ($genres as $genre) : ?>
			<?php if ($genre->genre_name == 'Progressive House') : ?>
				<li><a href="<?php echo base_url(); ?>index.php/<?php echo $genre->genre_slug; ?>">Prog House</a></li>
			<?php else : ?>
				<li><a href="<?php echo base_url(); ?>index.php/<?php echo $genre->genre_slug; ?>"><?php echo $genre->genre_name; ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	
	<h3>Contact</h3>
	<ul class="two-col">
		<li><a href="mailto:info@ch599.com">Email</a></li>
		<li><a href="https://twitter.com/channel599">Twitter</a></li>
		<li><a href="https://www.facebook.com/channel599">Facebook</a></li>
		<li><a href="http://www.youtube.com/user/channel599">Youtube</a></li>
	</ul>


</section>