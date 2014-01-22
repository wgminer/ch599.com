<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h3>Soundcloud Ripper</h3>

			<div class="well">

				<?php echo form_open('posts/download'); ?>
					
					<label for="soundcloud_url">Soundcloud URL</label>
					<input class="input-block-level" type="text" name="soundcloud_url">
				
					<input class="btn btn- btn-primary" type="submit" value="Submit">
				
				<?php echo form_close(); ?>

			</div>

		</div>

	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>