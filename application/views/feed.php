<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>
<?php $this->load->view('partials/controls'); ?>


<div class="hero">
	<p>You're on Channel 599,<br> a music blog started in Rob's room.</p>
</div>

<div class="feed" reload>
    <?php $this->load->view('partials/songs'); ?>
</div>

<?php if ($paginate) : ?>
<button class="paginate">Moar</button>
<?php endif; ?>

<?php $this->load->view('partials/footer'); ?>
