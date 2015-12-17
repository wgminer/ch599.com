<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>

<div class="hero">
    <h1 class="hero__title"><a href="latest">599</a></h1>
</div>

<div class="feed">
    
    <?php foreach ($songs as $song) : ?>

    <article class="song song--<?php echo $song->source; ?>">
        <div class="song__body">
            <div class="song__media">
                <div class="song__image">
                    <img src="<?php echo $song->image_url; ?>" alt="">
                </div>
            </div>
            <div class="song__content">
                <div class="song__center">
                    <h2 class="song__title"><a href=""><?php echo $song->title; ?></a></h2>
                    <?php if ($song->text) : ?><p class="song__text"><?php echo $song->text; ?></p><?php endif; ?>
                </div>
              </div>
        </div>
        
    </article>

    <?php endforeach; ?>

</div>

<?php $this->load->view('partials/footer'); ?>
