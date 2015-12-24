<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>
<?php $this->load->view('partials/controls'); ?>


<p class="hero">You're on <a href="<?php echo base_url() ?>">Channel 599</a>,<br> a music blog <a href="/authors">we</a> started in Rob's room.</div>
</p>

<div class="feed">
    <?php $this->load->view('partials/songs'); ?>
</div>

<button class="paginate">Moar</button>

<?php $this->load->view('partials/footer'); ?>
