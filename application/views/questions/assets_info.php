<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Assets Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-assets-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>7));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['num_properties'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="num_properties" style="width: 100%;">
                                    <option value="">Number of Properties</option>
                                    <?php echo Smart::selectListNumber(Smart::setValue('num_properties', $app->num_properties),0,10); ?>
                                </select>
                                 <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Other properties include cottages, investment properties, etc."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div> 
                    <br>
                </div>
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
        
    </div>

</section>