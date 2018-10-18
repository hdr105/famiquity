<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Assets Information", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-asset-details-info'), array("METHOD" => "POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                $this->load->view('shared/_bar', array('percentage' => $percentage, 'level'=>7));
                echo Smart::softErrors();
                echo Smart::formErrors();
                for ($i = 0; $i < $app->num_properties; $i++):
                    ?>
                    <div id="register-form" class="register-form">
                        <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['assets_property_title']);?></label>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="property_title_<?php echo $i; ?>" style="width: 100%;">
                                    <?php echo Smart::selectList($titles, 'id', 'name', Smart::setValue('property_title_' . $i, ($properties !== NULL) ? $properties[$i]->property_title : "")); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div> 
                        <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['assets_property_type']);?></label>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="property_type_<?php echo $i; ?>" style="width: 100%;">
                                    <?php echo Smart::selectList($types, 'id', 'name', Smart::setValue('property_type_' . $i, ($properties !== NULL) ? $properties[$i]->property_type : "")); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div>
                        <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['assets_property_value']);?></label>
                            <div class ='field-widget'>
                                <input type="number" min="0" step="25000" class="web form-control" name="property_value_<?php echo $i; ?>"  
                                       value="<?php echo Smart::setValue('property_value_' . $i, ($properties !== NULL) ? $properties[$i]->property_value : ""); ?>"
                                       data-message="Please Provide property value" style="height: 48px;">
                                       <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div> 
                        <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['assets_property_liens']);?></label>
                            <div class ='field-widget'>
                                <input type="number" min="0" step="25000" class="web form-control" name="property_liens_<?php echo $i; ?>"  
                                       value="<?php echo Smart::setValue('property_liens_' . $i, ($properties !== NULL) ? $properties[$i]->property_liens : ""); ?>"
                                       data-message="" style="height: 48px;">
                                       <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>

                            </div>
                        </div>
                        <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['assets_is_inherited']);?></label>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="is_inherited_<?php echo $i; ?>" style="width: 100%;">
                                    <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('is_inherited_' . $i, ($properties !== NULL) ? $properties[$i]->is_inherited : "")); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div>
                        <div class="section-field">
                            <label><?php echo str_replace("{VAR}", Constants::getnumberToText($i+1), $this->labelArray['assets_inheritance_converted']);?></label>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="inheritance_converted_<?php echo $i; ?>" style="width: 100%;">
                                    <?php echo Smart::selectList($inhretance, 'id', 'name', Smart::setValue('inheritance_converted_' . $i, ($properties !== NULL) ? $properties[$i]->inheritance_converted : "")); ?>
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <hr>
                <?php endfor; ?>

                <?php $this->load->view('shared/_buttons', array("prev_page" => $prev_page, "next_page" => $next_page)); ?>
            </div>
        </div>
        <?php
        echo form_close();
        ?>

    </div>

</section>