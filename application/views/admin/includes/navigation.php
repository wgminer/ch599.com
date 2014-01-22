<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container-fluid">
			
			<a href="<?php echo base_url(); ?>dashboard" class="brand">Dashboard</a>

			<ul class="nav">
				<li><a href="<?php echo base_url(); ?>settings">Settings</a></li>
				<li><a href="<?php echo base_url(); ?>tweet">Tweet</a></li>
				<li><a href="<?php echo base_url(); ?>facebook">Facebook</a></li>
				<li><a href="<?php echo base_url(); ?>new">New</a></li>
				<li><a href="<?php echo base_url(); ?>rip">Rip</a></li>
			</ul>
			<ul class="nav pull-right">
				<li><a href="http://www.ch599.com" target="_blank">Site</a></li>
				<li><a href="http://www.twitter.com/channel599" target="_blank">Twitter</a></li>
				<li><a href="https://www.facebook.com/channel599" target="_blank">Facebook</a></li>
				<li><a href="https://soundcloud.com/channel599" target="_blank">Soundcloud</a></li>
				<li><a href="http://www.youtube.com/user/CHANNEL599" target="_blank">Youtube</a></li>
				<li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
			</ul>

		</div>

	</div>

</div>

<?php if(isset($error)) : ?>
	<p class="error"><?php echo $error ?></p>
<?php endif ?>

<?php if(isset($success)) : ?>
	<p class="success"><?php echo $success ?></p>
<?php endif ?>