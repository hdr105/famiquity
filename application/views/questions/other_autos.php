<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Boats/RVs/Motorcycles/Other Cars", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-other-autos'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>7));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['other_autos'];?></label>
                        <div class ='field-widget'>
                            <input type="number" min="0" step="5000" class="form-control" required="required" autocomplete="off" name="other_autos"  value="<?php echo Smart::setValue('other_autos', $app->other_autos); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>"  style="height: 48px;">
                                   <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['other_autos_spouse'];?></label>
                        <div class ='field-widget'>
                            <input type="number" min="0" step="5000" class="form-control" required="required" autocomplete="off" name="other_autos_spouse"  value="<?php echo Smart::setValue('other_autos_spouse', $app->other_autos_spouse); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>"  style="height: 48px;">
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