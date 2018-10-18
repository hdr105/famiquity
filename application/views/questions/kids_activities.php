<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Kids Extracurricular Activities", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-kids-activities-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>3));
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                         <div class="input-group-btn help-select-list"> 
                            <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Extracurricular means paid activities like sports, music, special needs, etc"><i class="fa fa-2x fa-question-circle"></i></button>
                        </div>
                        <label><?php echo $this->labelArray['kids_activities'];?></label>

                        <div class="field-widget remember-checkbox">
                            <?php echo Smart::checkListSmart('kids_activities[]', $list, 'name', 'name', explode(",", $app->kids_activities))?>
                        </div>

                    </div> 
                    <br>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['activities_cost'];?></label>
                        <div class="input-group">
                            <input type="number" min="0" step="500" class="web form-control" required="required"  
                            autocomplete="off" name="activities_cost"  value="<?php echo Smart::setValue('activities_cost', $app->activities_cost); ?>"
                            data-message="<?php echo lang('req_kids_activites_cost') ?>" style="height: 48px;">
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