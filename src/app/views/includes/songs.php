<?php foreach ($songs as $song) : ?>

    <article class="song <?php echo $song->source ?>" data-source="<?php echo $song->source ?>" data-source-id="<?php echo $song->source_id ?>" data-source-url="<?php echo $song->source_url ?>">
                
        <section class="media">
            <div class="aspect-ratio">
                <img src="<?php echo $song->image_url ?>" alt="">
            </div>                        
        </section>
        <div class="content">
            <p class="date">
                <?php if (date('Y', strtotime($song->created_at)) != date('Y')) : ?>
                    <?php echo date('M j Y', strtotime($song->created_at)); ?>
                <?php else : ?>
                    <?php echo date('M j', strtotime($song->created_at)); ?>
                <?php endif; ?>
            </p>
            <h2 class="title"><a href="<?php echo base_url() ?><?php echo $song->slug ?>"><?php echo $song->title ?></a></h2>
            <p class="caption"><?php echo $song->text ?></p>
            <hr>
            <p class="meta"><a href="author/<?php echo $song->user_slug ?>"><?php echo $song->user_name ?></a></p>
            <p class="meta"><a href="genre/<?php echo $song->genre_slug ?>"><?php echo $song->genre_name ?></a></p>
            
        </div>
        <!--
        <div class="annotations">
            <?php if ($song->annotations) : ?>
            <?php foreach ($song->annotations as $annotation) : ?>
                <div class="annotation" data-source-id="<?php echo $song->source_id ?>" data-timestamp="<?php echo $annotation->timestamp ?>">
                    <p class="time"><?php echo $annotation->time ?></p>
                    <p class="comment"><?php echo $annotation->text ?></p>
                </div>
            <?php endforeach;  endif; ?>
        </div>
        -->
    </article>

<?php endforeach; ?>