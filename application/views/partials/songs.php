<?php if ($songs) : ?>

<?php foreach ($songs as $song) : ?>

    <article class="song song--<?php echo $song->source; ?>" source="<?php echo $song->source; ?>" source-id="<?php echo $song->source_id; ?>" source-url="<?php echo $song->source_url; ?>">
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
        <h2 class="song__title"><a href="<?php echo base_url() ?>song/<?php echo $song->slug; ?>"><?php echo $song->title; ?></a></h2>
    </article>

<?php endforeach; ?>

<?php else : ?>

    <div class="null">
        <p>Nothing more...</p>
    </div>
    
<?php endif; ?>