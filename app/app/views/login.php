<!doctype html>
<html class="no-js">
    <?php $this->load->view('includes/head.admin.php'); ?>
    <body>

        <div class="login">
            <div class="center">
        
                <?php echo form_open('auth'); ?>

                    <label for="email">Email</label>
                    <input id="email" type="email" name="email">
                    
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password">    
                            
                    <button class="button" type="submit">Submit</button>
                
                <?php echo form_close(); ?>

            </div>
        </div>

        <script src="//localhost:35729/livereload.js"></script> 

    </body>
</html>

