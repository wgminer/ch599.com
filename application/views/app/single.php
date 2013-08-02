<?php $this->load->view('app/includes/header'); ?>

<?php $this->load->view('app/includes/menu'); ?>

<div id="wrap">

	<?php $this->load->view('app/includes/navbar'); ?>

	<?php if ($post->post_source == 'youtube') : ?>

		<article id="<?php echo $post->post_media ?>" class="single youtube">

	<?php elseif ($post->post_source == 'soundcloud') : ?>

		<article id="<?php echo $post->post_media ?>" class="single soundcloud">

	<?php endif; ?>

			<section class="content">

				<div class="media">

					<?php if ($post->post_source == 'youtube') : ?>
					
						<iframe src="http://www.youtube.com/embed/<?php echo $post->post_media ?>?html5=1&autoplay=1"></iframe>

					<?php elseif ($post->post_source == 'soundcloud') : ?>

						

					<?php endif; ?>

				</div>

			</section>

			<section class="caption">

				<h2 class="title" title="<?php echo $post->post_title ?>"><a href="<?php echo base_url(); ?>index.php/<?php echo $post->post_slug ?>"><?php echo $post->post_title ?></a></h2>

				<div class="meta">
					<span class="date"><i class="icon-calendar"></i><?php echo date('F j', strtotime($post->post_created)); ?></span>
					<span class="author"><i class="icon-user"></i><a href="<?php echo base_url(); ?>index.php/author/<?php echo strtolower($post->post_author); ?>"><?php echo $post->post_author ?></a></span>
					<span class="share"><i class="icon-link"></i><a href="">Share</a></span>
				</div>

				<?php if(isset($post->post_text)) : ?>
					<span class="comment"><i class="icon-comment"></i><?php echo $post->post_text ?></span>
				<?php endif; ?>

			</section>

		</article>

</div>

<?php $this->load->view('app/includes/autoplay'); ?>

<?php $this->load->view('app/includes/footer'); ?>
