<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Annual Income", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-income-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                
                <?php
                $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>2));
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['highest_income'];?></label>
                        <div class="field-widget">
                            <input type="number" min="0" step="10000" class="form-control" required="required" autocomplete="off" name="highest_income"  value="<?php echo Smart::setValue('highest_income', $app->highest_income); ?>"
                            data-message="<?php echo lang('req_annual_income') ?>" style="height: 48px;">
                            <div class="input-group-btn help-select-list "> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Include all sources of income for the most accurate Risk Report.
                                "><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>


                        </div>


                    </div> 
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['s_highest_income'];?></label>
                        <div class="field-widget">
                            <input type="number" min="0" step="10000" class="form-control" required="required"  
                            autocomplete="off" name="s_highest_income"  value="<?php echo Smart::setValue('s_highest_income', $app->s_highest_income); ?>"
                            data-message="<?php echo lang('req_annual_income_p') ?>" style="height: 48px;">
                            <div class="input-group-btn help-select-list "> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Include all sources of income for the most accurate Risk Report.
                                "><i class="fa fa-2x fa-question-circle"></i></button>
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
