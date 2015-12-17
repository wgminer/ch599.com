<?php $this->load->view('partials/head'); ?>

    <?php echo form_open('auth', 'class=login'); ?>
        
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


<?php $this->load->view('partials/footer'); ?>
