<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Cohabitation Year", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-cohabitaion-info'), array("METHOD" => "POST"));
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
                        <label><?php echo $this->labelArray['cohabitation_date'];?></label>
                        <div class="field-widget">
                            <div class="small-list">
                                <select class="Wide fancyselect1" name="month">
                                    <option value="">Select Month</option>
                                    <?php echo Smart::selectListMonth(Smart::setValue('month', ($app->moved_date !== NULL)?date('m', strtotime($app->moved_date)):'')); ?>
                                </select>
                            </div>
                            <div class="small-list">
                                <select class="Wide fancyselect1" name="year">
                                    <option value="">Select Year</option>
                                    <?php echo Smart::selectListYear(Smart::setValue('year', ($app->moved_date !== NULL)?date('Y', strtotime($app->moved_date)):''), 1960); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
        echo form_close();
        ?>

    </div>

</section>