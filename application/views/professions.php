<?php $this->load->view('shared/_page_banner_empty'); ?>

<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Professions", "txt3" => "")); ?>
    <div class="container form-margin">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <h6>Select your profession below and learn about potential risks</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="feature-text box-shadow text-center mb-30 white-bg">
                    <div class="feature-icon">
                        <img src="<?php echo Smart::loadAsset('images/icons/worker-with-safety-helmet.png') ?>">
                    </div>
                    <div class="fature-info"> 
                        <h4 class="text-back pt-20 pb-10">911</h4>
                        <a class="button mt-20" href="<?php echo base_url('911');?>">read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-text box-shadow text-center mb-30 white-bg">
                    <div class="feature-icon">
                        <img src="<?php echo Smart::loadAsset('images/icons/classroom.png') ?>">
                    </div>
                    <div class="fature-info"> 
                        <h4 class="text-back pt-20 pb-10">Teacher</h4>
                        <a class="button mt-20" href="<?php echo base_url('teacher');?>">read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-text box-shadow text-center mb-30 white-bg">
                    <div class="feature-icon">
                        <img src="<?php echo Smart::loadAsset('images/icons/medical.png') ?>">
                    </div>
                    <div class="fature-info"> 
                        <h4 class="text-back pt-20 pb-10">Medical</h4>
                        <a class="button mt-20" href="<?php echo base_url('medical');?>">read more</a>
                    </div>
                </div>
            </div>
            </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="feature-text box-shadow text-center mb-30 white-bg">
                    <div class="feature-icon">
                        <img src="<?php echo Smart::loadAsset('images/icons/office-chair.png') ?>">
                    </div>
                    <div class="fature-info"> 
                        <h4 class="text-back pt-20 pb-10">Executives</h4>
                        <a class="button mt-20" href="<?php echo base_url('executive');?>">read more</a>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4 col-sm-6">
                <div class="feature-text box-shadow text-center mb-30 white-bg">
                    <div class="feature-icon">
                        <img src="<?php echo Smart::loadAsset('images/icons/dollar-sign-and-piles-of-coins.png') ?>">
                    </div>
                    <div class="fature-info"> 
                        <h4 class="text-back pt-20 pb-10">High Finance</h4>
                        <a class="button mt-20" href="<?php echo base_url('finance');?>">read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-text box-shadow text-center mb-30 white-bg">
                    <div class="feature-icon">
                        <img src="<?php echo Smart::loadAsset('images/icons/seo.png') ?>">
                    </div>
                    <div class="fature-info"> 
                        <h4 class="text-back pt-20 pb-10">Consultants</h4>
                        <a class="button mt-20" href="<?php echo base_url('consultant');?>">read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="red-bg page-section-ptb ">
    <div class="col-lg-12 col-md-12 text-center red-bg">
        <a href="<?php echo base_url('buy-gift'); ?>" class="text-center"><img src="<?php echo Smart::loadAsset('images/gift-card.jpg') ?>" /></a>
    </div>
</section>