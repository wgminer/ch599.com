<!doctype html>
<html class="no-js">
    <?php $this->load->view('includes/head.admin.php'); ?>
    <body>

        <div class="login">
            <div class="center">
        
                <?php echo form_open('users/create'); ?>
                                
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name">

                    <label for="email">Email</label>
                    <input id="email" type="email" name="email">
                    
                    <label for="password">Password</label>
                    <input id="passowrd" type="password" name="password">    
                    
                    <label for="bio">Bio</label>
                    <textarea id="bio" type="text" name="bio" rows="10"></textarea>
                
                    <input type="submit" value="Submit">
                
                <?php echo form_close(); ?>

            </div>
        </div>

        <?php $this->load->view('includes/scripts.admin.php'); ?>
    </body>
</html>

