<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Risk Report", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-income-info'), array("METHOD" => "POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 risk">
                <h1 class="text-center">You are at high risk</h1>

                <h2 class="text-center">Risk Amount: <?php echo Smart::formatCurrency($risk); ?></h2>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar " role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">You are here</div>
                </div>
                <p>
                   Above is the total dollar value you may be at risk, as well as the risk level.
                </p>
                <p>
                    The total dollar value is calculated by inputting the answers you provided, into family and property calculators available in your jurisdiction. The risk level is calculated by combining your answers, with Famiquity's relationship breakdown algorithms.
                </p>
                <p>
                    If you are interested in exploring ways to reduce these risks, please continue to complete the questionnaire, as we need more detailed information in order to produce a report. Famiquity does not provide legal or financial advice. What we can do is provide detailed reports, which may assist financial, legal, and other professionals to provide you advice. A benefit of the reports is they may narrow down the issues, and therefore reduce costs with the appropriate professional.
                </p>
                <?php
                echo Smart::softErrors();
                echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">

                    </div> 
                    <br>
                    <div class="section-field">
                        <!-- JUNAID -->
                        <?php if(Smart::isAuthorized()){ ?>
                        <a href="<?php echo base_url('restart-application/'.$this->session->appId); ?>" class="btn btn-lg btn-info">Continue Questionnaire</a>
                        <a href="<?php echo base_url('contact-us-info'); ?>" class="btn btn-lg btn-success">Save & Exit</a>
                        <?php } elseif ($next_page != "") {
                            ?>
                            <a href="<?php echo base_url('contact-us-info'); ?>" class="btn btn-lg btn-info">Continue Questionnaire</a>
                            <a href="<?php echo base_url('contact-us-info'); ?>" class="btn btn-lg btn-success">Save & Exit</a>
                        <?php
                        } else{?>
                        <a href="<?php echo base_url('restart-temp-application/'.$this->session->appId); ?>" class="btn btn-lg btn-info">Continue Questionnaire</a>
                        <a href="<?php echo base_url('contact-us-info'); ?>" class="btn btn-lg btn-success">Save & Exit</a>
                        
                        <?php }?>
                            
                    </div> 
                </div>
                
            </div>
        </div>
        <?php
        echo form_close();
        ?>

    </div>

</section>