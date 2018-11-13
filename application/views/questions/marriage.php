<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Marriage Date", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-marriage-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>0));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                    
                ?>
                <div id="register-form" class="register-form">
                    <div>
                    <h5>Life Decision : <?php echo $this->session->userdata('life_decision'); ?></h5>
                    <hr>
                  </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['month'];?></label>
                        <div class="field-widget">
                            <div class="small-list">
                                <select class="Wide fancyselect1" name="month">
                                    <option value="">Select Month</option>
                                    <?php echo Smart::selectListMonth(Smart::setValue('month', ($app->married_date !== NULL)?date('m', strtotime($app->married_date)):'')); ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <select class="Wide fancyselect1" name="year" style="width: 100%;">
                                    <option value='DESC'>Select Year</option>
                                    <?php echo Smart::selectListYear(Smart::setValue('year', ($app->married_date !== NULL)?date('Y', strtotime($app->married_date)):''),1960); ?>
                                  
                                </select>
                                <div class="input-group-btn help-select-list"> 
                                    <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll to select the correct date.
                                    "><i class="fa fa-2x fa-question-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
        
    </div>

</section>