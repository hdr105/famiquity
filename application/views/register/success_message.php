<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="register-form" class="register-form">
                    <h5><?php echo $message;?></h5>
                </div>
            </div>
        </div>
    </div>
</section>