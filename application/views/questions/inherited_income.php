<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Inheritance Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-inherited-income'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>5));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['income_from_inherited_property'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="income_from_inherited_property" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('income_from_inherited_property', $app->income_from_inherited_property)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div> 
                    <div class="section-field">
                        <label><?php echo $this->labelArray['income_from_property_excluded_gifter'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="income_from_property_excluded_gifter" style="width: 100%;">
                                <?php echo Smart::selectList($list2, 'id', 'name', Smart::setValue('income_from_property_excluded_gifter', $app->income_from_property_excluded_gifter)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="An appropriate lawyer can advise you if the documentation is sufficient."><i class="fa fa-2x fa-question-circle"></i></button>
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