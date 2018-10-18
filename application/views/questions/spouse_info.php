<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Spouse Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-spouse-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>4));
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['s_first_name'];?></label>
                        <div class="input-group">
                            <input type="text" class="web form-control" name="s_first_name"  
                            value="<?php echo Smart::setValue('s_first_name', $app->s_first_name); ?>"
                            data-message="<?php echo lang('req_spouseinfo_name') ?>">
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="We would insert this when addressing them in the SmartPlan feature."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['s_email'];?></label>
                        <div class="input-group">
                            <input type="email" class="web form-control" name="s_email"  
                            value="<?php echo Smart::setValue('s_email', $app->s_email); ?>"
                            data-message="<?php echo lang('req_spouseinfo_email') ?>">
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="We recommend an email that is not connected to their finances."><i class="fa fa-2x fa-question-circle"></i></button>
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