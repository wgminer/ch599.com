<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>
<?php $this->load->view('partials/controls'); ?>

<div class="hero">
    <p><?php echo $author->name; ?></p>
    <?php if ($author->bio != '') : ?>
        <p>"<?php echo $author->bio; ?>"</p>
    <?php endif; ?>
</div>

<div class="feed" reload>
    <?php $this->load->view('partials/songs'); ?>
</div>

<?php if ($paginate) : ?>
<button class="paginate">Moar</button>
<?php endif; ?>

<?php $this->load->view('partials/footer'); ?>