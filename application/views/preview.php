<?php $this->load->view('shared/_page_banner_empty'); ?>

<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Questionnaire Preview", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row"> 
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <img src="<?php echo Smart::loadAsset('images/ss/01.jpg') ?>" class="img-responsive" /><br><br>
                        <img src="<?php echo Smart::loadAsset('images/ss/02.jpg') ?>" class="img-responsive" /><br><br>
                        <img src="<?php echo Smart::loadAsset('images/ss/03.jpg') ?>" class="img-responsive" /><br><br>
                        <img src="<?php echo Smart::loadAsset('images/ss/04.jpg') ?>" class="img-responsive" /><br><br>
                        <img src="<?php echo Smart::loadAsset('images/ss/05.jpg') ?>" class="img-responsive" /><br><br>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>

