<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Financial Responsibility", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-financial-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>2));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['bill_payments_manager'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="bill_payments_manager" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('bill_payments_manager', $app->bill_payments_manager)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['s_expense_status'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="s_expense_status" style="width: 100%;">
                                <?php echo Smart::selectList($list2, 'id', 'name', Smart::setValue('s_expense_status', $app->s_expense_status)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
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