<?php $this->load->view('desktop/includes/head'); ?>

<body>

	<?php $this->load->view('desktop/includes/menu'); ?>

	<div id="wrap">

		<?php $this->load->view('desktop/includes/topbar'); ?>

		<section id="info" class="fade-in">
			<h2><?php echo $author->author_name; ?></h2>
			<img src="<?php echo base_url(); ?>assets/img/<?php echo $author->author_photo; ?>" alt="">
			<p><?php echo $author->author_bio; ?></p>
		</section>

		<section id="playlist" class="fade-in">

			<?php $this->load->view('desktop/includes/loop'); ?>

		</section>

		<?php $this->load->view('desktop/includes/footer'); ?>

	</div>

	<?php $this->load->view('desktop/includes/scripts'); ?>
	
</body>
</html>