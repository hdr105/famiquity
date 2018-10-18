<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Edit Question", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">   
                
                <?php
                echo Smart::formErrors();
                ?>
                <?php 
                    echo form_open(base_url('update-question')); 
                    echo form_hidden('id', $obj->id);
                ?>

                <div id="register-form" class="register-form">

                    <div class="section-field">
                        <label>Question</label>
                        <div class="field-widget">
                            <input type="text" class="web form-control" required="required" pattern="[<?php echo Constants::$REGEX_SAFE_NO_TAG; ?>]{2,400}" 
                                   autocomplete="off" name="question"  value="<?php echo Smart::setValue('question', $obj->question); ?>"
                                   data-message="Please provide a valid question between 2-400 characters" >

                        </div>  
                    </div> 
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
