<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Cheating with Spouse", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-has-relationship'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>6));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['has_relationship_outside'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="has_relationship_outside" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('has_relationship_outside', $app->has_relationship_outside)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Meaning flirting with someone in social media/email/text format."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="section-field">
                        <label><?php echo $this->labelArray['s_know_relationship'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="s_know_relationship" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('s_know_relationship', $app->s_know_relationship)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="To your knowledge, did they find out?"><i class="fa fa-2x fa-question-circle"></i></button>
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