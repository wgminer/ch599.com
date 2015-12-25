<!DOCTYPE html>
<html ng-app="599">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if (isset($title)) : ?><?php echo $title; ?> | <?php endif; ?>Channel 599</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
        <script src="https://use.typekit.net/owf6hsl.js"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>
        <link rel="stylesheet" href="<?php echo base_url() ?>public/css/599.css">
    </head>
    <body>
        <div class="toast" toast>{{ message }}</div>
        
    