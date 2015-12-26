<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>
<?php $this->load->view('partials/controls'); ?>

<article class="song song--single song--<?php echo $song->source; ?>" source="<?php echo $song->source; ?>" source-id="<?php echo $song->source_id; ?>" source-url="<?php echo $song->source_url; ?>">
    <div class="song__media">
        <div class="song__image">
            <img src="<?php echo $song->image_url; ?>" alt="">
        </div>
        <div class="song__info">
            <div class="song__play-icon">
                <i class="ion-play"></i>
            </div>
            <p class="song__author"><a href="<?php echo base_url() ?>author/<?php echo $song->user_slug; ?>"><?php echo $song->user_name; ?></a></p>
            <p class="song__genre"><a href="<?php echo base_url() ?>genre/<?php echo $song->genre_slug; ?>"><?php echo $song->genre_name; ?></a></p>
            <p class="song__created"><?php echo $song->created_at; ?></p>
            <?php if ($song->text) : ?><p class="song__text">"<?php echo $song->text; ?>"</p><?php endif; ?>
        </div>
    </div>
    <h2 class="song__title"><?php echo $song->title; ?></h2>
</article>

<?php if ($related) : ?>
<div class="related-group">
    <h2 class="related-group__title">Related</h2>

<?php foreach ($related as $song) : ?>

    <a href="<?php echo base_url() ?>song/<?php echo $song->slug; ?>" class="related related--<?php echo $song->source; ?>">
        <div class="song__media">
            <div class="song__image">
                <img src="<?php echo $song->image_url; ?>" alt="">
            </div>
        </div>
    </a>

<?php endforeach; ?>

</div>

<?php endif; ?>

<?php $this->load->view('partials/footer'); ?>
