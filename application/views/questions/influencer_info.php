<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Influencer Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-influencer'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>9));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                    $confide = explode(",", $app->confide);
                    foreach ($confide as $c):
                        $influencerObject = (array_key_exists ($c,$influencers))?$influencers[$c]:NULL;
                        $infObj = $list[$c];
                        if($influencerObject !== NULL){
                            $contactY = ((int)$influencerObject->can_contact === 1)?'checked="checked"':'';
                            $contactN = ((int)$influencerObject->can_contact === 0)?'checked="checked"':'';
                        }else{
                            $contactY = 'checked="checked"';
                            $contactN = '';
                        }
                ?>
                <div id="register-form" class="register-form">
                    <div class="row">
                        <div class="section-field col-md-6">
                        <label><?php echo str_replace("{VAR}", $infObj->name, $this->labelArray['inf_first_name']);?></label>
                        <div class="field-widget">
                            <input type="text" class="form-control" required="required"  
                                   autocomplete="off" name="first_name_<?php echo $infObj->id?>"  value="<?php echo Smart::setValue('first_name', ($influencerObject !== NULL)?$influencerObject->first_name:""); ?>"
                                   data-message="<?php echo lang('req_fname') ?>">
                        </div>
                    </div>
                    <div class="section-field  col-md-6">
                        <label><?php echo str_replace("{VAR}", $infObj->name, $this->labelArray['inf_email']);?></label>
                        <div class="field-widget">
                            <input type="email" class="form-control" required="required"  
                                   autocomplete="off" name="email_<?php echo $infObj->id?>"  value="<?php echo Smart::setValue('email', ($influencerObject !== NULL)?$influencerObject->email:""); ?>"
                                   data-message="<?php echo lang('req_fname') ?>">
                        </div>
                    </div> 
                    </div>
                    
                    
                    <?php
                    /*<div class="section-field">
                        <label>When do you ask your <?php echo $infObj->name?> for advice?</label>
                        <div class="field-widget">
                            <select class="Wide fancyselect1" name="when_ask_advice_<?php echo $infObj->id?>">
                                <?php echo Smart::selectList($list1, 'id', 'name', Smart::setValue('when_ask_advice', ($influencerObject !== NULL)?$influencerObject->first_name:"")); ?>
                            </select>
                        </div>
                    </div> */
                    ?>
                    
                    
                    <div class="section-field">
                        <label><?php echo str_replace("{VAR}", $infObj->name, $this->labelArray['inf_can_contact']);?></label>
                        <div>
                            <label for="yes_<?php echo $infObj->id?>" class="mr-20"><input type="radio" class="radio-inline" name="can_contact_<?php echo $infObj->id?>" <?php echo $contactY;?> value="1" id='yes_<?php echo $infObj->id?>'> &nbsp;Yes</label>
                            <label for="no_<?php echo $infObj->id?>"><input type="radio" class="radio-inline" name="can_contact_<?php echo $infObj->id?>" value="0" id="no_<?php echo $infObj->id?>" <?php echo $contactN;?>> &nbsp;No</label>
                        </div>
                    </div> 
                    
                </div>
                <hr>
                <?php endforeach;?>
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
        
    </div>

</section>