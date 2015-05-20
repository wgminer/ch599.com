<?php foreach ($songs as $song) : ?>

    <article class="song song--<?php echo $song->source ?>" data-source="<?php echo $song->source ?>" data-source-id="<?php echo $song->source_id ?>" data-source-url="<?php echo $song->source_url ?>">
                
        <section class="song__media media">
            <div class="song__aspect-ratio">
                <img src="<?php echo $song->image_url ?>" alt="">
            </div>                        
        </section>
        <div class="song__content">
            <h2 class="song__title"><a href="<?php echo base_url() ?><?php echo $song->slug ?>"><?php echo $song->title ?></a></h2>
            <p class="song__text"><?php echo $song->text ?></p>
            <!--             
            <p class="song__date">
                <?php if (date('Y', strtotime($song->created_at)) != date('Y')) : ?>
                    <?php echo date('M j Y', strtotime($song->created_at)); ?>
                <?php else : ?>
                    <?php echo date('M j', strtotime($song->created_at)); ?>
                <?php endif; ?>
            </p>
            <p class="song__meta"><a href="author/<?php echo $song->user_slug ?>"><?php echo $song->user_name ?></a></p>
            <p class="song__meta"><a href="genre/<?php echo $song->genre_slug ?>"><?php echo $song->genre_name ?></a></p>
            -->
        </div>

    </article>

<?php endforeach; ?>