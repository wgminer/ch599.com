<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>
<?php $this->load->view('partials/controls'); ?>


<p class="hero">You're on <a href="/">Channel 599</a>,<br> a music blog <a href="/authors">we</a> started in Rob's room.</div>
</p>

<div class="feed">
    
    <?php foreach ($songs as $song) : ?>

    <article class="song song--<?php echo $song->source; ?>">
        <div class="song__media">
            <div class="song__image">
                <img src="<?php echo $song->image_url; ?>" alt="">
            </div>
            <div class="song__info">
                <div class="song__play-icon">
                    <i class="ion-play"></i>
                </div>
                <p class="song__author"><a href="/<?php echo $song->user_slug; ?>"><?php echo $song->user_name; ?></a></p>
                <p class="song__genre"><a href="/<?php echo $song->genre_slug; ?>"><?php echo $song->genre_name; ?></a></p>
                <p class="song__created"><?php echo $song->created_at; ?></p>
                <?php if ($song->text) : ?><p class="song__text">"<?php echo $song->text; ?>"</p><?php endif; ?>
            </div>
        </div>
        <h2 class="song__title"><a href=""><?php echo $song->title; ?></a></h2>
    </article>

    <?php endforeach; ?>

</div>

<?php $this->load->view('partials/footer'); ?>
