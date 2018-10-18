<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Bank Accounts (Worldwide)", "txt3" => "")); ?>
    <div class="container form-margin">
        <?php
            echo form_open(base_url('save-bank-accounts'), array("METHOD"=>"POST"));
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                    $this->load->view('shared/_bar', array('percentage'=>$percentage, 'level'=>7));
                    echo Smart::softErrors();
                    echo Smart::formErrors();
                ?>
                <div id="register-form" class="register-form">
                    <div class="section-field">
                        <label><?php echo $this->labelArray['bank_accounts'];?></label>
                        <div class="input-group">
                            <input type="number" min="0" step="5000" class="form-control" required="required" autocomplete="off" name="bank_accounts"  value="<?php echo Smart::setValue('bank_accounts', $app->bank_accounts); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>" style="height: 48px;">
                                   <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="section-field">
                        <label><?php echo $this->labelArray['bank_accounts_spouse'];?></label>
                        <div class="input-group">
                            <input type="number" min="0" step="5000" class="form-control" required="required" autocomplete="off" name="bank_accounts_spouse"  value="<?php echo Smart::setValue('bank_accounts_spouse', $app->bank_accounts_spouse); ?>"
                                   data-message="<?php echo lang('req_gift_value') ?>" style="height: 48px;">
                                   <div class="input-group-btn help-select-list"> 
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top"  data-content="Use the scroll button to estimate the total value."><i class="fa fa-2x fa-question-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('shared/_buttons', array("prev_page"=>$prev_page,"next_page"=>$next_page, "show_assessment"=>$show_assessment));?>
            </div>
        </div>
        <?php
            echo form_close();
        ?>
        
    </div>

</section>