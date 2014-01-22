<?php $this->load->view('mobile/includes/head'); ?>

<body>

	<?php $this->load->view('mobile/includes/topbar'); ?>

	<section id="info">
		<img src="<?php echo base_url(); ?>assets/img/<?php echo $genre->genre_photo; ?>" alt="">
		<h2><?php echo $genre->genre_name; ?></h2>		
	</section>

	<section id="playlist">

		<?php $this->load->view('mobile/includes/loop'); ?>

	</section>

	<?php echo script_tag(base_url().'assets/js/vendor/zepto.js'); ?>
  	<?php echo script_tag(base_url().'assets/js/mobile.js'); ?>

	<?php $this->load->view('mobile/includes/scripts'); ?>
	
</body>
</html>