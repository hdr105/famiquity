<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden"><br><br>
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Add Financial Advisor", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row mt-20">

            <?php 
                echo form_open_multipart(base_url('create-advisor'), array("method" => "POST"));
            ?>
            <div class="col-md-6 col-md-offset-3">
                
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label>Name*</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{2,100}" 
                                   autocomplete="off" name="first_name"  value="<?php echo Smart::setValue('first_name'); ?>"
                                   data-message="<?php echo lang('req_fname') ?>" >

                        </div>  
                    </div> 

                    <div class="section-field">
                        <label><?php echo lang('email') ?>*</label>
                        <div class="field-widget">
                            <input type="email" required="required" class="form-control" name="email_address" autocomplete="off" 
                                   value="<?php echo Smart::setValue('email_address'); ?>"
                                   data-message="<?php echo lang('req_email') ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label><?php echo lang('city') ?>*</label>
                            <div class="field-widget">
                                <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_NO_TAG; ?>]{2,100}" 
                                       autocomplete="off" name="city"  value="<?php echo Smart::setValue('city'); ?>"
                                       data-message="<?php echo lang('req_city') ?>" >

                            </div>  
                        </div> 
                        <div class="section-field col-md-6">
                            <label><?php echo lang('postal_code') ?>*</label>
                            <div class="field-widget">
                                <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{3,10}" 
                                       autocomplete="off" name="postal_code"  value="<?php echo Smart::setValue('postal_code'); ?>"
                                       data-message="<?php echo lang('req_postal_code') ?>" >

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
                    <div class="section-field">
                        <label><?php echo lang('institution') ?>*</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" pattern="[<?php echo Constants::$REGEX_SAFE_NO_TAG; ?>]{2,150}" 
                                   autocomplete="off" name="institue_practice"  value="<?php echo Smart::setValue('institue_practice'); ?>"
                                   data-message="<?php echo lang('req_practice_type') ?>" >

                        </div>  
                    </div>
                    <div class="section-field mt-10">
                        <label>Compose Email:</label>
                        <textarea name="message" class="form-control cke" style="height:200px;" id="message" row="15">
                            <p>we appreciate your interest in our innovative new family wealth management protection tool.</p>
                            <p>Here's a quick video explaining how to easily set up your clients <a href="<?php echo base_url();?>">Play Video</a>.</p>
                            Should you have any questions at any time, don’t hesitate to contact us, or visit our FAQ webpage.  Thanks again!
                        </textarea>
                    </div>
                </div>
                <button class="button mt-20" type="submit">
                    <span>Add Advisor</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>