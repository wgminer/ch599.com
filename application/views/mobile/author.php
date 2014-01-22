<?php $this->load->view('mobile/includes/head'); ?>

<body>

	<?php $this->load->view('mobile/includes/topbar'); ?>

	<section id="info">
		<img src="<?php echo base_url(); ?>assets/img/<?php echo $author->author_photo; ?>" alt="<?php echo $author->author_name; ?> | Channel 599">
		<h2><?php echo $author->author_name; ?></h2>
	</section>

	<section id="playlist">

		<?php $this->load->view('mobile/includes/loop'); ?>

	</section>

	<?php echo script_tag(base_url().'assets/js/vendor/zepto.js'); ?>
  	<?php echo script_tag(base_url().'assets/js/mobile.js'); ?>

	<?php $this->load->view('mobile/includes/scripts'); ?>
	
</body>
</html>