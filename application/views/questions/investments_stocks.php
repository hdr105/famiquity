<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Investments/stocks", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-investments-stocks'), array("METHOD"=>"POST"));
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
                        <label><?php echo $this->labelArray['investments_stocks'];?></label>
                        <div class="field-widget">
                            <input type="number" min="0" step="10000" class="form-control" required="required" autocomplete="off" name="investments_stocks"  value="<?php echo Smart::setValue('investments_stocks', $app->investments_stocks); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>">
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['investments_stocks_spouse'];?></label>
                        <div class="field-widget">
                            <input type="number" min="0" step="10000" class="form-control" required="required" autocomplete="off" name="investments_stocks_spouse"  value="<?php echo Smart::setValue('investments_stocks_spouse', $app->investments_stocks_spouse); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>">
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