<?php $this->load->view('desktop/includes/head'); ?>

<body>

	<?php $this->load->view('desktop/includes/menu'); ?>

	<div id="wrap">

		<?php $this->load->view('desktop/includes/topbar'); ?>

		<section id="playlist" class="fade-in">

			<?php $this->load->view('desktop/includes/loop'); ?>

		</section>

		<?php $this->load->view('desktop/includes/footer'); ?>

	</div>

	<?php $this->load->view('desktop/includes/scripts'); ?>
	
</body>
</html>