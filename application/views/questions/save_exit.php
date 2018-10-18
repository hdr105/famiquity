<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Save And Exit", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1 class="text-center">We need more information</h1>
                <p>We need more information to provide you a Risk Report</p>
                <div id="register-form" class="register-form">
                    <br>
                    <div class="section-field text-center">
                            <!-- JUNAID -->
                         <?php $back = $_SERVER['HTTP_REFERER']; ?>
                        <a href="<?php echo $back; ?>" class="btn btn-lg btn-info">Continue</a> 
                        <a href="<?php echo base_url('contact-us-info'); ?>" class="btn btn-lg btn-success">Save & Exit</a>     
                    </div> 
                </div>
                
            </div>
        </div>
    </div>

</section>