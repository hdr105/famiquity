<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => " ", "txt2" => "Life Decision", "txt3" => " ")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('temp-app'), array("METHOD"=>"POST"));
        ?>
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>0));
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['decision_id'];?>*</label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="decision_id" style="width: 100%;">
                                <?php echo Smart::selectList($decision_list, 'id', 'name', Smart::setValue('decision_id', $app->decision_id)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Select one, you will receive a report based on this life decision.
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