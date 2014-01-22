<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">

			<h3>Download Assets<small>...you theif</small></h3>
			
			<textarea name="" class="input-block-level" rows="10">_PUT CH599.COM LINK HERE_&#10;&#10;_PUT ARTIST NAME HERE_&#10;_PUT LINKS TO ARTISTS' SOCIAL MEDIA_&#10;&#10;Grabbed the song from here:&#10;<?php echo $source ?>&#10;&#10;If you want the song taken down, just shoot us a message (info@ch599.com) and we'll take it down immediately.</textarea>

			<p>
				<a class="btn btn-primary btn-large" href="<?php echo $img ?>" download="<?php echo $slug ?>">Download Image</a>
				<a class="btn btn-primary btn-large" download="<?php echo $slug ?>" href="<?php echo $url ?>?client_id=<?php echo $id ?>">Download Mp3</a>
			</P>

		</div>

	</div>

</div>
	

<?php $this->load->view('admin/includes/footer'); ?>