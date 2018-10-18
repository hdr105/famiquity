<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Trust Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-trust-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>5));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['trust_setup'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="trust_setup" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('trust_setup', $app->trust_setup)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['trust_income_draw_amount'];?></label>
                        <div class ='field-widget'>
                            <input type="number" min="0" step="10000" class="web form-control" required="required" autocomplete="off" name="trust_income_draw_amount"  value="<?php echo Smart::setValue('trust_income_draw_amount', $app->trust_income_draw_amount); ?>"
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