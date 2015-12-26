<!DOCTYPE html>
<html ng-app="599">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if (isset($title)) : ?><?php echo $title; ?> | <?php endif; ?>Channel 599</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
        <link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700|Oxygen+Mono|Source+Code+Pro:400,300,500,700,200' rel='stylesheet' type='text/css'>        
        <link rel="stylesheet" href="<?php echo base_url() ?>public/css/599.css">
    </head>
    <body>
        <div class="toast" toast>{{ message }}</div>
        
    