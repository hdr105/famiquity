<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Home Status", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-home-title-info'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>2));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['home_title'];?></label>
                        <div class="input-group">
                            <select class="Wide fancyselect1" name="home_title" style="width: 100%;">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('home_title', $app->home_title)); ?>
                            </select>
                            <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content=""><i class="fa fa-2x fa-question-circle"></i></button>
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