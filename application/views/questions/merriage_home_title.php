<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Home Status", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-home-title-marriage-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>0));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['merriage_home_title'];?></label>
                        <div class="field-widget">
                            <select class="Wide fancyselect1" name="merriage_home_title">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('merriage_home_title', $app->merriage_home_title)); ?>
                            </select>
                        </div>
                    </div> 
                    <div class="section-field">
                        <label><?php echo $this->labelArray['have_moved'];?></label>
                        <div class="field-widget">
                            <select class="Wide fancyselect1" name="have_moved">
                                <?php echo Smart::selectList($list_moved, 'id', 'name', Smart::setValue('have_moved', $app->have_moved)); ?>
                            </select>
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