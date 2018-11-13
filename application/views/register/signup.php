<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "Don't have an Account?", "txt2" => "Save your Data", "txt3" => "In order to save your answers please provide email and password.")); ?>
    <div class="container form-margin">

        <div class="row">

            <?php echo form_open(base_url('accept-terms-and-conditions')); ?>
            <div class="col-md-8 col-md-offset-2">
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">

                    <div class="section-field">
                        <label><?php echo lang('first_name') ?>*</label>
                        <div class="input-group">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{2,100}" 
                                   autocomplete="off" name="first_name"  value="<?php echo Smart::setValue('first_name'); ?>"
                                   data-message="<?php echo lang('req_fname') ?>">
                                   <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="What's your first name?
                                "><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            

                        </div>  
                    </div> 

                    <div class="section-field">
                        <label><?php echo lang('email') ?>*</label>
                        <div class="input-group">
                            <input type="email" required="required" class="form-control" name="email_address" autocomplete="off" 
                                   value="<?php echo Smart::setValue('email_address'); ?>"
                                   data-message="<?php echo lang('req_email') ?>">
                                       <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="What's your email address?
                                "><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label><?php echo lang('password') ?>*</label>
                            <div class="field-widget">

                                <input type="password" class="form-control" required="required" pattern="<?php echo Constants::$REGEX_SAFE_PWD; ?>" 
                                       autocomplete="off" name="password" 
                                       data-message="<?php echo lang('pwd_validation') ?>" >
                            </div> 
                        </div>
                        <div class="section-field col-md-6">
                            <label><?php echo lang('confirm_password') ?>*</label>
                            <div class="field-widget">

                                <input type="password" class="form-control" required="required" pattern=".{6,16}" autocomplete="off" name="confirm_password"  >
                            </div> 
                        </div>
                    </div>
                    <div class="section-field">
                        <label>Select Province *</label>
                        <div class="input-group">
                            <select class="Wide fancyselect" name="province">
                                <?php echo Smart::selectList($provinces, 'id', 'name', Smart::setValue('province')) ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Thank you for your interest, but currently the Risk Calculator is only available for Ontario."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php /*<div class="section-field">
                        <div class="remember-checkbox">
                            <input type="checkbox" value="1" name="terms_conditions" id="terms_conditions" required="" data-message="<?php echo lang('req_agree_to_terms') ?>">
                            <label for="terms_conditions">Accept our <a href="#"> privacy policy</a> and <a href="#"> customer agreement</a></label>
                        </div>
                    </div>*/?>
                    <div class="section-field">
                        <?php echo $widget; ?>
                        <?php echo $script; ?>
                    </div>
                </div>
                <button class="button mt-20" type="submit">
                    <span>Save Now</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
                <div class="form-group">
                    <?php echo lang('already_account') ?> <a href="<?php echo base_url("sign-in") ?>">
                    <?php echo lang('sign_in') ?>
                    </a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>