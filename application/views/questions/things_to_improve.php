<?php $this->load->view('shared/_page_banner', array("heading" => "relationship status", "desc" => "", "image" => Smart::loadImages('bg/02.jpg'))); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "relationship status", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-kids-communicate-info'), array("METHOD"=>"POST"));
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
                        <label>If there are three things you would improve about your partner/spouse, what would they be?</label>
                        <div class="field-widget">
                            <select class="Wide fancyselect1" name="night_without_s">
                                <?php echo Smart::selectList($list, 'id', 'name', Smart::setValue('night_without_s', $app->night_without_s)); ?>
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