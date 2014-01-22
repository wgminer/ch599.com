<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<!-- Load the Facebook JavaScript SDK -->
<div id="fb-root"></div>

<div class="container">
	
	<div class="row">
		
		<div class="span6 offset3">
			
			<h3><?php if (isset($post)) { echo '3 of 3: '; } ?>Compose Facebook Post</h3>

			<input id="loginButton" class="btn btn-primary btn-large" type="button" value="Login"/>

			<?php echo form_open('posts/post_facebook', array('style' => 'display:none')); ?>

				<label for="facebook_url">Link</label>	
				<input name="facebook_url" type="text" class="input-block-level" value="<?php if (isset($post)) { echo 'ch599.com/'.$post->post_slug; } ?>">
				
				<label for="facebook_text">Message</label>	
				<textarea id="facebook-text" name="facebook_text" class="input-block-level" rows="5"><?php if (isset($post)) { echo $post->post_text; } ?></textarea>
				
				<p>				
					<input class="btn btn-primary btn-large" type="submit" value="Post to Facebook">
					<?php if (isset($post)) : ?>
						<a href="<?php echo base_url()?>edit/<?php echo $post->post_id ?>" class="btn btn-link btn-large">Skip</a>
					<?php endif; ?>
					<input id="logoutButton" class="btn btn-link btn-large pull-right" type="button" value="Logout" style="display:none;"/>
				</p>

			<?php echo form_close(); ?>
	
		</div>

	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>