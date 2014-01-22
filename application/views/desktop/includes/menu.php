<nav id="menu">
	<h3>Authors</h3>
	<ul class="two-col">
		<?php foreach ($authors as $author) : ?>
			<li><a href="<?php echo base_url(); ?><?php echo $author->author_slug; ?>"><?php echo $author->author_name; ?></a></li>
		<?php endforeach; ?>
	</ul>

	<h3>Genres</h3>
	<ul class="two-col expand">
		<?php foreach ($genres as $genre) : ?>
			<?php if ($genre->genre_name == 'Progressive House') : ?>
				<li><a href="<?php echo base_url(); ?><?php echo $genre->genre_slug; ?>">Prog House</a></li>
			<?php else : ?>
				<li><a href="<?php echo base_url(); ?><?php echo $genre->genre_slug; ?>"><?php echo $genre->genre_name; ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<button id="show-more"><i class="icon-plus"></i> <span>More</span></button>
	
	<h3>Contact</h3>
	<ul class="two-col">
		<li><a href="mailto:info@ch599.com">Email</a></li>
		<li><a href="https://twitter.com/channel599">Twitter</a></li>
		<li><a href="https://www.facebook.com/channel599">Facebook</a></li>
		<li><a href="http://www.youtube.com/user/channel599">Youtube</a></li>
	</ul>

	<p>You're on Channel 599, a video music blog started in Rob's room in 2010.</p>

</nav>

<div id="search" style="display:none;">
	
	<form action="search" method="GET">
		
		<input name="q" type="search" placeholder="Type + Enter = Search">

	</form>

</div>