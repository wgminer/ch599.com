<?php $this->load->view('admin/includes/header'); ?>
<?php $this->load->view('admin/includes/navigation'); ?>

<div class="container">
	
	<div class="row">
		
		<div class="span6">
			
			<h3><?php if (isset($post)) { echo '2 of 3: '; } ?>Compose Tweet</h3>

			<?php echo form_open('posts/post_tweet'); ?>

				<?php if(isset($error)) : ?>
				<p class="error"><?php echo $error ?></p>
				<?php endif ?>

				<?php if(isset($success)) : ?>
				<p class="success"><?php echo $success ?></p>
				<?php endif ?>

				<input type="hidden" name="facebook" value="<?php echo $facebook ?>">

				<?php if ($facebook) : ?>
					<input type="hidden" name="id" value="<?php echo $post->post_id ?>">
				<?php endif ?>

				<textarea id="tweet-text" name="tweet_text" class="input-block-level" rows="5"><?php if (isset($post)) { echo $post->post_text.' ch599.com/'.$post->post_mini_url; } ?></textarea>
				
				<p>
					<input style="margin-top:10px;" class="btn btn-primary btn-large" type="submit" value="Post Tweet">
					<?php if (isset($post)) : ?>
						<a href="<?php echo base_url()?>facebook?id=<?php echo $post->post_id ?>" class="btn btn-link btn-large">Skip</a>
					<?php endif; ?>
				</p>

			<?php echo form_close(); ?>
	
		</div>

		<div class="span6">
			
			<a class="twitter-timeline" href="https://twitter.com/channel599" data-widget-id="364548667916558336">Tweets by @channel599</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		</div>

	</div>

</div>

<?php $this->load->view('admin/includes/footer'); ?>