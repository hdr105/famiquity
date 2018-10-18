<?php $this->load->view('shared/_page_banner', array("heading" => "register", "desc" => "We know the secret of your success", "image" => Smart::loadImages('bg/02.jpg'))); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "Don't have an Account? Register Now.", "txt2" => "Register An Account", "txt3" => "We know the secret of your success")); ?>
    <div class="container form-margin">

        <div class="row">

            <?php
            echo form_open(base_url($action));
            echo form_hidden('aid', $obj->id);
            ?>
            <div class="col-md-8 col-md-offset-2">
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">

                    <div class="section-field">
                        <label>Institute Name*</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{2,100}" 
                                   autocomplete="off" name="name"  value="<?php echo Smart::setValue('name', $obj->name); ?>"
                                   data-message="<?php echo lang('req_fname') ?>" >

                        </div>  
                    </div>
                    <div class="section-field">
                        <label>Address</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" 
                                   autocomplete="off" name="address"  value="<?php echo Smart::setValue('address', $obj->address); ?>" >
                        </div>  
                    </div> 
                    <div class="section-field">
                        <label>Contact Person Name*</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_ALPHANUMERIC; ?>]{2,100}" 
                                   autocomplete="off" name="contact_person"  value="<?php echo Smart::setValue('contact_person', $obj->contact_person); ?>"
                                   data-message="<?php echo lang('req_fname') ?>" >
                        </div>  
                    </div>
                    <div class="section-field">
                        <label><?php echo lang('email') ?></label>
                        <div class="field-widget">
                            <input type="email" class="form-control" name="email" autocomplete="off" 
                                   value="<?php echo Smart::setValue('email', $obj->email); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>Phone</label>
                            <div class="field-widget">

                                <input type="text" class="form-control" value="<?php echo Smart::setValue('phone', $obj->phone); ?>"
                                       autocomplete="off" name="phone"  >
                            </div> 
                        </div>
                        <div class="section-field col-md-6">
                            <label>Fax</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" value="<?php echo Smart::setValue('fax', $obj->fax); ?>"
                                       autocomplete="off" name="fax"  >
                            </div> 
                        </div>
                    </div>
                    <?php if($isEdit === TRUE):?>
                    <div class="section-field">
                        <label>Status</label>
                        <div class="field-widget">
                            <select name="status" class="form-control"  required="">
                                <?php echo Smart::selectList(Constants::getStatusList(), 'id', 'name', $obj->status) ?>
                            </select>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <button class="button mt-20" type="submit">
                    <span>Save</span>
                    <i class="fa fa-arrow-right"></i>
                </button>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>