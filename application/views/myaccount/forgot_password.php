<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Forgot Password", "txt3" => "")); ?>
    <div class="container form-margin">

        <div class="row">

            <?php echo form_open(base_url('reset-password')); ?>
            <div class="col-md-6 col-md-offset-3">
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">
                    <p>Please provide the email address associated with your account and we will send you a temporary password.<br>We recommend you to reset your password after logging in.</p>
                    <div class="section-field">
                        <label><?php echo lang('email') ?></label>
                        <div class="field-widget">
                            <input type="email" required="required" class="form-control" name="email_address" autocomplete="off" 
                                   value="<?php echo Smart::setValue('email_address'); ?>"
                                   data-message="<?php echo lang('req_email') ?>">
                        </div>
                    </div>
                    <div class="section-field">
                        <?php echo $widget; ?>
                        <?php echo $script; ?>
                    </div>
                </div>
                <button class="button mt-20" type="submit">
                    <span>Reset Password</span>
                    <i class="fa fa-arrow-right"></i>
                </button>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>