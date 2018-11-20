<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Children Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-gift-detail-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>7));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                    $life_decision = true;
                    for ($i=0; $i < $app->num_gifts; $i++):
                ?>
                <div id="register-form" class="register-form">
                    
                    <?php if($life_decision == TRUE){ ?>
                   <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>

                </div>
                 <?php $life_decision = FALSE; } ?>
                    <div class="section-field">
                        <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['gift_value']);?></label>
                        <div class="input-group">
                            <input type="text" class="web form-control" name="value_<?php echo $i;?>" required=""  
                                   value="<?php echo Smart::setValue('value_'.$i, ($gifts !== NULL)?$gifts[$i]->value:""); ?>"
                                   data-message="Please specify value" >
                                   <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['gift_is_converted']);?></label>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="is_converted_<?php echo $i; ?>" style="width: 100%;">
                                    <?php echo Smart::selectList($inhretance, 'id', 'name', Smart::setValue('is_converted_' . $i, ($properties !== NULL) ? $properties[$i]->is_converted : "")); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div>
                    <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['gift_has_proof']);?></label>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="has_proof_<?php echo $i; ?>" style="width: 100%;">
                                    <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('has_proof_' . $i, ($properties !== NULL) ? $properties[$i]->has_proof : "")); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="You may check with an appropriate lawyer to validate."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div>
                    
                    <div class="clearfix"></div>
                    
                </div>
                
                <?php endfor;?>
                
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
    </div>
</section>