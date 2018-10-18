<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Cash Value Life and Disability Insurance", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-disability-insurance'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>7));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['disability_insurance'];?></label>
                        <div class="input-group">
                            <input type="number" min="0" step="10000" class="form-control" required="required" autocomplete="off" name="disability_insurance"  value="<?php echo Smart::setValue('disability_insurance', $app->disability_insurance); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>" style="height: 48px;">
                                                                      <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['disability_insurance_spouse'];?></label>
                        <div class="input-group">
                            <input type="number" min="0" step="10000" class="form-control" required="required" autocomplete="off" name="disability_insurance_spouse"  value="<?php echo Smart::setValue('disability_insurance_spouse', $app->disability_insurance_spouse); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>" style="height: 48px;">
                                                                      <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
        
    </div>

</section>