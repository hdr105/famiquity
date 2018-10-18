<?php $this->load->view('shared/_page_banner_empty'); ?>

<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Executives", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-lg-6 col-md-6 sm-mb-30">
                <div class="js-video [vimeo, widescreen] big">
                    <iframe width="560" height="300" src="https://www.youtube.com/embed/abSuROujRbc?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mb-20 sub-pages">
                    <h3>Corporate Executives are subject to higher levels of risks of relationship breakdowns due to the combination of long hours, business travel and socializing and positions of power.  It’s perceived as a well paid profession and the financial risk increases if their spouses/partners are stay at home or low income earners.</h3>
                    <a href="<?php echo base_url("life-decision"); ?>" class="btn btn-lg btn-primary">Start Assessment Now</a>
                </div>
            </div>
        </div>
        <div class="row">
            <br>
        </div>
    </div>
</section>

<section class="red-bg page-section-ptb ">
    <div class="col-lg-12 col-md-12 text-center red-bg">
        <a href="<?php echo base_url('buy-gift');?>" class="text-center"><img src="<?php echo Smart::loadAsset('images/gift-card.jpg') ?>" /></a>
    </div>
</section>