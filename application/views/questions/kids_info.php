<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Children Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-kids-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>3));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                    for ($i=0; $i < $app->num_kids; $i++):
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['kids_first_name']);?></label>
                        <div class="field-widget">
                            <input type="text" class="form-control" name="first_name_<?php echo $i;?>"  
                                   value="<?php echo Smart::setValue('first_name_'.$i, ($kids !== NULL)?$kids[$i]->first_name:""); ?>"
                                   data-message="<?php echo lang('req_fname') ?>">
                        </div>
                    </div> 
                    <div class="section-field">
                        <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['kids_dob']);?></label>
                        <div class="field-widget">
                            <div class="small-list">
                                <select class="Wide fancyselect1" name="day_<?php echo $i;?>">
                                    <option value="">Select Day</option>
                                    <?php echo Smart::selectListNumber(Smart::setValue('day', ($kids !== NULL)?date('d', strtotime($kids[$i]->dob)):''), 1, 31); ?>
                                </select>
                            </div>
                            <div class="small-list">
                                <select class="Wide fancyselect1" name="month_<?php echo $i;?>">
                                    <option value="">Select Month</option>
                                    <?php echo Smart::selectListMonth(Smart::setValue('month',  ($kids !== NULL)?date('m', strtotime($kids[$i]->dob)):'')); ?>
                                </select>
                            </div>
                            <div class="small-list">
                                <select class="Wide fancyselect1" name="year_<?php echo $i;?>">
                                    <option value="">Select Year</option>
                                    <?php echo Smart::selectListYear(Smart::setValue('year', ($kids !== NULL)?date('Y', strtotime($kids[$i]->dob)):'')); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
                <hr>
                <?php endfor;?>
                
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
        
    </div>

</section>