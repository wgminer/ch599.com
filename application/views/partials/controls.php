<div class="bar">
	<div class="control-group control-group--site">
		<a class="control control--home" href="<?php echo base_url() ?>latest"><i class="ion-home"></i></a>
		<button class="control control--search"><i class="ion-search"></i></button>
	</div>
	<div class="control-group control-group--player is--playing">
		<button class="control control--prev"><i class="ion-chevron-up"></i></button>
		<button class="control control--play"><i class="ion-play"></i></button>
		<button class="control control--pause"><i class="ion-pause"></i></button>
		<button class="control control--loading"><i class="ion-load-c  control--spin"></i></button>
		<button class="control control--next"><i class="ion-chevron-down"></i></button>
	</div>
</div>
<div class="search">
	<button class="search__close"><i class="ion-close"></i></button>
	<form class="search__form" action="<?php echo base_url() ?>search" method="GET">
		<input name="q" type="search" placeholder="Search" class="search__input">
	</form>
	<div class="search__links">
		<div class="search__column">
			<h3 class="search__list-title">Authors</h3>
			<ul class="search__list">
				<?php foreach ($authors as $author) : ?>
				<li><a href="<?php echo base_url() ?>author/<?php echo $author->slug; ?>"><?php echo $author->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="search__column">
			<h3 class="search__list-title">Genres</h3>
			<ul class="search__list search__list--float">
				<?php foreach ($genres as $genre) : ?>
				<li><a href="<?php echo base_url() ?>genre/<?php echo $genre->slug; ?>"><?php echo $genre->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>