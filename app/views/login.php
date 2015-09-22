<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
        
        <script src="//use.typekit.net/owf6hsl.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>

        <link rel="stylesheet" href="<?php echo base_url() ?>/public/admin/css/main.css">
    </head>
    <body>

        <div class="login">
            <div class="login__container">
        
                <?php echo form_open('auth', 'class=login__form'); ?>
                    
                    <div class="form-group">
                        <label class="form-group__label" for="email">Email</label>
                        <input class="form-group__control" id="email" type="email" name="email">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-group__label" for="password">Password</label>
                        <input class="form-group__control" id="password" type="password" name="password"> 
                    </div>
                       
                            
                    <button class="button" type="submit">Submit</button>
                
                <?php echo form_close(); ?>

            </div>
        </div>

    </body>
</html>

