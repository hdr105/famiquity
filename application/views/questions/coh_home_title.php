<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Home Status", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-past-cohabitaion-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>0));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['coh_home_title'];?></label>
                        <div class="field-widget">
                            <select class="Wide fancyselect1" name="coh_home_title">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('coh_home_title', $app->coh_home_title)); ?>
                            </select>
                        </div>
                    </div> 
                    <div class="section-field">
                        <label><?php echo $this->labelArray['coh_home_value'];?></label>
                        <div class="field-widget">
                            <input type="number" step="25000" min="0" class="form-control" required="required" autocomplete="off" name="coh_home_value"  value="<?php echo Smart::setValue('coh_home_value', $app->coh_home_value); ?>"
                                   data-message="<?php echo lang('req_value_coh') ?>">
                        </div>
                    </div> 
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['coh_mortgage_value'];?></label>
                        <div class="field-widget">
                            <input type="number" step="25000" min="0" class="form-control" required="required"  
                                   autocomplete="off" name="coh_mortgage_value"  value="<?php echo Smart::setValue('coh_mortgage_value', $app->coh_mortgage_value); ?>"
                                   data-message="<?php echo lang('req_mortgage_value_coh') ?>">
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