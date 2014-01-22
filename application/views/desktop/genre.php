<?php $this->load->view('desktop/includes/head'); ?>

<body>
	
	<?php $this->load->view('desktop/includes/menu'); ?>

	<div id="wrap">

		<?php $this->load->view('desktop/includes/topbar'); ?>

		<section id="info" class="fade-in">
			<h2 <?php if(strpos($genre->genre_name,' ') !== false && $genre->genre_name != 'Nu Disco' && $genre->genre_name != 'Chill Out') { echo 'style="top:45px"'; } ?>><?php echo $genre->genre_name; ?></h2>
			<img src="<?php echo base_url(); ?>assets/img/<?php echo $genre->genre_photo; ?>" alt="">
			<p><?php echo $genre->genre_info; ?></p>
		</section>

		<section id="playlist" class="fade-in">

			<?php $this->load->view('desktop/includes/loop'); ?>

		</section>

		<?php $this->load->view('desktop/includes/footer'); ?>

	</div>

	<?php $this->load->view('desktop/includes/scripts'); ?>
	
</body>
</html>