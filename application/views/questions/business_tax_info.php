<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Additional Income", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-business-tax-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>5));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['bus_personal_expense'];?></label>
                        <div class="field-widget">
                            <input type="number" min="0" step="1000" class="form-control" autocomplete="off" name="bus_personal_expense"  
                                   value="<?php echo Smart::setValue('bus_personal_expense', $app->bus_personal_expense); ?>"
                                   data-message="<?php echo lang('req_addincome_expense') ?>">
                        </div>
                    </div> 
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['share_percentage'];?></label>
                        <div class="field-widget">
                            <input type="number" class="form-control" min="0" max="100" 
                                   autocomplete="off" name="share_percentage"  value="<?php echo Smart::setValue('share_percentage', $app->share_percentage); ?>"
                                   data-message="<?php echo lang('req_addincome_percentage') ?>">
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