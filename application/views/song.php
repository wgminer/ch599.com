<!DOCTYPE html>
<html ng-app="599">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php if (isset($title)) : ?><?php echo $title; ?> | <?php endif; ?>Channel 599</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        
        <meta name="description" content="<?php if (isset($song->description)) { echo $song->description; } else { echo 'You\'re on Channel 599, a video music blog started in Rob\'s room.'; } ?>">
        <meta id="og-img" property="og:image" content="<?php echo $song->image_url ?>">
        
        <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/ico">

        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
        <link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700|Oxygen+Mono|Source+Code+Pro:400,300,500,700,200' rel='stylesheet' type='text/css'>        
        
        <link rel="stylesheet" href="<?php echo base_url() ?>public/css/599.css">
    
    </head>
    <body>
        <div toast class="toast toast--{{ status }}" >{{ message }}</div>
        
    
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
