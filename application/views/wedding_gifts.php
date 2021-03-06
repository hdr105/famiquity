<?php $this->load->view('shared/_page_banner_empty'); ?>

<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Wedding Gifts", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-lg-6 col-md-6 sm-mb-30">
                <div class="js-video [vimeo, widescreen] big">
                    <iframe width="560" height="300" src="https://www.youtube.com/embed/ydICAJ7unfI?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="section-title mb-20">
                    <h2>A great gift that will keep your loved one protect their wealthy and happiness</h2>
                    <a href="<?php echo base_url("fa-sign-up"); ?>" class="btn btn-lg btn-primary">Register</a>
                    <a href="<?php echo base_url("sign-in"); ?>" class="btn btn-lg btn-warning">Sign In</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center"><br>
                <a href="<?php echo base_url("questionnaire-preview"); ?>" class="btn btn-lg btn-primary">Questionnaire Preview</a>
                <a href="<?php echo base_url("assets/sample.pdf"); ?>" class="btn btn-lg btn-primary">Solutions Sample</a>
                <a href="<?php echo base_url("faqs"); ?>" class="btn btn-lg btn-primary">FAQs</a>
                <a href="<?php echo base_url("buy-gift"); ?>" class="btn btn-lg btn-primary">Buy a Gift Card Now</a>
                <br>
            </div>
        </div>
    </div>
</section>

<section class="red-bg page-section-ptb ">
    <div class="col-lg-12 col-md-12 text-center red-bg">
        <a href="<?php echo base_url('buy-gift');?>" class="text-center"><img src="<?php echo Smart::loadAsset('images/gift-card.jpg') ?>" /></a>
    </div>
</section>