<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>
<?php $this->load->view('partials/controls'); ?>

<div class="authors">
	<div class="authors__text"></div>
	<div class="authors__images">
		<div class="authors__inner">
			<div class="column">
				<div class="image">
					<div class="image__overlay"></div>
					<img src="<?php echo base_url() ?>public/img/599_1.jpg" alt="">
				</div>
				<div class="image">
					<div class="image__overlay"></div>
					<img src="<?php echo base_url() ?>public/img/599_3.jpg" alt="">
				</div>
			</div>
			<div class="column">
				<div class="image">
					<div class="image__overlay"></div>
					<img src="<?php echo base_url() ?>public/img/599_4.jpg" alt="">
				</div>
				
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('partials/footer'); ?>
