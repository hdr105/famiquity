<?php $this->load->view('shared/_page_banner', array("heading" => "Edit User", "desc" => "", "image" => Smart::loadImages('bg/02.jpg'))); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Edit Users", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">   
                
                <?php
                echo Smart::formErrors();
                ?>
                <?php 
                    echo form_open(base_url('update-user')); 
                    echo form_hidden('aid', $obj->id);
                ?>

                <div id="register-form" class="register-form">

                    <div class="section-field">
                        <label><?php echo lang('full_name') ?>*</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{2,100}" 
                                   autocomplete="off" name="first_name"  value="<?php echo Smart::setValue('first_name', $obj->first_name); ?>"
                                   data-message="<?php echo lang('req_fname') ?>" >

                        </div>  
                    </div> 

                    <div class="section-field">
                        <label><?php echo lang('email') ?> : <?php echo $obj->email;?></label>
                    </div>
                    <?php if((int)$obj->role_id === 3 || (int)$obj->role_id === 4):?>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label><?php echo lang('city') ?>*</label>
                            <div class="field-widget">
                                <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_NO_TAG; ?>]{2,100}" 
                                       autocomplete="off" name="city"  value="<?php echo Smart::setValue('city', $obj->city); ?>"
                                       data-message="<?php echo lang('req_city') ?>" >

                            </div>  
                        </div> 
                        <div class="section-field col-md-6">
                            <label><?php echo lang('postal_code') ?>*</label>
                            <div class="field-widget">
                                <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{3,10}" 
                                       autocomplete="off" name="postal_code"  value="<?php echo Smart::setValue('postal_code', $obj->postal_code); ?>"
                                       data-message="<?php echo lang('req_postal_code') ?>" >

                            </div>  
                        </div> 
                    </div>
                    <?php endif;?>
                    <div class="section-field">
                        <label>Select Province *</label>
                        <div class="input-group">
                            <select class="Wide fancyselect" name="province">
                                <?php echo Smart::selectList($provinces, 'id', 'name', Smart::setValue('province', $obj->province)) ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Thank you for your interest, but currently the Risk Calculator is only available for Ontario."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php if((int)$obj->role_id === 3 || (int)$obj->role_id === 4):?>
                    <div class="section-field">
                        <label><?php echo lang('institution') ?>*</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_NO_TAG; ?>]{2,150}" 
                                   autocomplete="off" name="institue_practice"  value="<?php echo Smart::setValue('institue_practice', $obj->institue_practice); ?>"
                                   data-message="<?php echo lang('req_practice_type') ?>" >

                        </div>  
                    </div> 
                    <?php endif; ?>
                </div>
                <div class="input-group-block">
                    <label>Select Role</label>
                    <select name="role_id" class="form-control"  required="">
                            <?php echo Smart::selectList($roles, 'id', 'name', $obj->role_id)?>
                        </select>
                </div>
                <div class="input-group-block">
                    <label>Status</label>
                    <select name="active" class="form-control"  required="">
                            <?php echo Smart::selectList(Constants::getStatusList(), 'id', 'name', $obj->active)?>
                        </select>
                </div>
                <button class="button mt-20" type="submit">
                    <span>Update</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
