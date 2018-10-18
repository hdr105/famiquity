<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "Have an Account? Sign in Now", "txt2" => "Sign in", 
                        "txt3" => "Don't Have an Account? <a href='".base_url("sign-up")."'>Register</a>")); ?>
    <div class="container form-margin">

        <div class="row">

            <?php echo form_open(base_url('do-sign-in')); ?>
            <div class="col-md-6 col-md-offset-3">
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo lang('email') ?></label>
                        <div class="field-widget">
                            <input type="email" class="form-control" name="txt_user" autocomplete="off" 
                                   value=""
                                   data-message="<?php echo lang('req_email') ?>">
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo lang('password') ?></label>
                        <div class="field-widget">
                            <input type="password" class="form-control" required="required" autocomplete="off" name="txt_password" >
                        </div>
                    </div>
                    <div class="section-field">
                        <?php echo $widget; ?>
                        <?php echo $script; ?>
                    </div>
                </div>
                <button class="button mt-20" type="submit">
                    <span>Sign In</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
                <div class="form-group">
                    <a href="<?php echo base_url("forgot-password"); ?>">Forgot Password?</a><br />
                    Don't Have an Account? <a href="<?php echo base_url("sign-up") ?>">
                    Register
                    </a>
                    
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>