
<section class="rev-slider">
    <div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="webster-slider-7" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
        <!-- START REVOLUTION SLIDER 5.4.5.2 fullwidth mode -->
        <div id="rev_slider_2_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.5.2">
            <ul>  <!-- SLIDE  -->

                <!-- SLIDE  -->
                <li data-index="rs-4" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="revolution/assets/slider-07/160x70_29f21-02.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="<?php echo Smart::loadAsset('images/bg/02.jpg'); ?>"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                </li>
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
    </div>
</section>  
<section class="page-section-ptb maroon-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 sm-mb-30">
                <div class="js-video [vimeo, widescreen] big">
                    <iframe width="560" height="300" src="https://www.youtube.com/embed/wXNH1OliYTk?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="section-title mb-20">
                                <h2>Famiquity uniquely defines the financial risks of life decisions, from a family and property perspective</h2>
                            </div>
                        </div>
                 </div>
        <div class="row"> <br></div>
    </div>
</section>
<section class="our-services page-section-ptb gray-bg">
    <?php
            echo form_open(base_url('temp-app'), array("METHOD"=>"POST"));
        ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-20">
                <h3>Get your FREE Risk Report Now!</h3>
                <div class="divider"></div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['decision_id'];?>*</label>
                        <div class="field-widget">
                            <select class="Wide fancyselect1" name="decision_id" style="width:100%;">
                                <?php echo Smart::selectList($decision_list, 'id', 'name', Smart::setValue('decision_id')); ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="col-md-2">
                <div class="section-field">
                    <label>&nbsp;</label>
                    <div class="field-widget">
                <button name="save" class="button"><span>Start</span>
                    <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            echo form_close();
        ?>
</section>


<section class="red-bg page-section-ptb ">
            <div class="col-lg-12 col-md-12 text-center red-bg">
                <a href="<?php echo base_url('buy-gift');?>" class="text-center"><img src="<?php echo Smart::loadAsset('images/gift-card.jpg')?>" /></a>
            </div>
        
</section>