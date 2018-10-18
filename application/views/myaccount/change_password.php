<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Change Password", "txt3" => "")); ?>
    <div class="container form-margin">

        <div class="row">

            <?php echo form_open(base_url('update-password')); ?>
            <div class="col-md-6 col-md-offset-3">
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo Lang('enter_current_pw'); ?></label>
                        <div class="field-widget">
                            <input id="login-username" type="password" required="required" pattern=".{6,16}" class="form-control" 
                           name="old_pwd" value=""  autocomplete="off"
                           data-message="<?php echo Lang('pwd_validation'); ?>" >
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo Lang('enter_new_pw'); ?></label>
                        <div class="field-widget">
                            <input type="password" required="required" name="pwd" autocomplete="off"
                           pattern="<?php echo Constants::$REGEX_SAFE_PWD; ?>" class="form-control"
                           data-message="<?php echo Lang('pwd_validation'); ?>" >
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo Lang('confirm_new_pw'); ?></label>
                        <div class="field-widget">
                            <input type="password" pattern=".{6,16}" required="required" autocomplete="off"
                           class="form-control" name="confirm_password" value="" 
                           data-message="<?php echo Lang('pwd_validation'); ?>" >
                        </div>
                    </div>
                    
                </div>
                <button class="button mt-20" type="submit">
                    <span>Change Password</span>
                    <i class="fa fa-arrow-right"></i>
                </button>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>