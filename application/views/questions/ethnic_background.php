<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Ethnic Background", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-ethnic-background'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>6));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['same_ethnic_background'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="same_ethnic_background" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('same_ethnic_background', $app->same_ethnic_background)); ?>
                            </select>
                             <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="This is relevant to your risk level."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div> 
                    <div class="section-field">
                        <label><?php echo $this->labelArray['issues_based_ethnicity'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="issues_based_ethnicity" style="width: 100%;">
                                <?php echo Smart::selectList($list2, 'id', 'name', Smart::setValue('issues_based_ethnicity', $app->issues_based_ethnicity)); ?>
                            </select>
                             <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="This is relevant to your risk level."><i class="fa fa-2x fa-question-circle"></i></button>
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