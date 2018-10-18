<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Alerting Suspension", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
        echo form_open(base_url('save-income-info'), array("METHOD" => "POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 risk">
                
                <h2 class="text-center">Alerting Suspension of use of this application until you have received therapy.</h2>
            </div>
        </div>
        <?php
        echo form_close();
        ?>

    </div>

</section>