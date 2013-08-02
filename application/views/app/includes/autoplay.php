<nav id="autoplay" class="panel">
	<ul>
		<li><a href="<?php echo base_url(); ?>index.php/songs">Songs</a></li>
		<li><a href="<?php echo base_url(); ?>index.php/sets">Sets</a></li>
		<li class="dropdown"><span>Authors</span>
			<ul class="sub-menu" style="display:none;">
				<?php if (count($authors) <= 1) : ?>
						<li><a href="<?php echo base_url(); ?>index.php/<?php echo strtolower($authors->user_name); ?>"><?php echo $authors->user_name; ?></a></li>
				<?php else : ?>
					<?php foreach ($authors as $author) : ?>
						<li><a href="<?php echo base_url(); ?>index.php/<?php echo strtolower($author->user_name); ?>"><?php echo $author->user_name; ?></a></li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</li>
		<li class="dropdown"><span>Genres</span>
			<ul class="sub-menu" style="display:none;">
	
			</ul>
		</li>
	</ul>
	<ul>
		<li><a href="">Twitter</a></li>
		<li><a href="">Facebook</a></li>
		<li><a href="">Soundcloud</a></li>
	</ul>

</nav>