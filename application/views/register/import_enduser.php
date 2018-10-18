<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Import Clients", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a href="<?php echo base_url('add-client'); ?>" class="button">Add Client</a>
                <div class="divider icon"> <span> OR </span> </div>
            </div>

        </div>
        
        <div class="row mt-20">

            <?php
            echo form_open_multipart(base_url('import-endusers'), array("method" => "POST"));
            ?>
            <div class="col-md-6 col-md-offset-3">
                <h4>Bulk Import</h4>
                <?php
                echo Smart::formErrors();
                echo Smart::softErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <span class="small">Browse and Select list of users which you want to import under your account.<br>
                            <a href="<?php echo Smart::loadAsset('docs/client-sample.csv')?>">Click here</a> to download sample file.</span>
                        <br><br>
                            <input id="my-file-selector" name="csvbatch" type="file">
                    </div>
                    <div class="section-field mt-10">
                        <label>Compose Email:</label>
                        <textarea name="message" class="form-control cke" style="height:200px;" id="message" row="15">
                            <p>we appreciate your interest in our innovative new family wealth management protection tool.</p>
                            <p>Here's a quick video explaining how to easily set up your clients <a href="<?php echo base_url();?>">Play Video</a>.</p>
                            Should you have any questions at any time, don’t hesitate to contact us, or visit our FAQ webpage.  Thanks again!
                        </textarea>
                    </div>
                </div>
                <div class="section-field">
                    <button class="button mt-20" type="submit">
                        <span>Import Clients</span>
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>