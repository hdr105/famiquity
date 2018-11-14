<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Children with Spouse", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-kids-basic-info'), array("METHOD"=>"POST"));
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
                        <label><?php echo $this->labelArray['num_kids'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="num_kids" style="width: 100%;">
                                    <option value="">Number of Kids</option>
                                    <?php echo Smart::selectListNumber(Smart::setValue('num_kids', $app->num_kids),0,5,'none', TRUE); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="This does not include children from another relationship.
                                "><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div> 
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['num_late_nights'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="num_late_nights" style="width: 100%;">
                                    <?php echo Smart::selectListNumber(Smart::setValue('num_late_nights', $app->num_late_nights), 0); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="This answer impacts your Risk Report.
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