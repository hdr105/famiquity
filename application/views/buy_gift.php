<?php $this->load->view('shared/_page_banner_empty'); ?>

<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Buy Gift", "txt3" => "")); ?>
    <div class="container form-margin">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="register-form" class="register-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>Who are you buying a Famiquity gift card for?</label>
                                <div class="field-widget">
                                    <select class="Wide fancyselect1" name="buy_for" style="width:100%;">
                                        <?php echo Smart::selectList($buy_for, 'id', 'name', Smart::setValue('decision_id')); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>Recipient's Email<br> &nbsp;</label>
                                    <div class="field-widget">
                                        <input type="text" class="form-control" placeholder="Email" name="name">
                                    </div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>Recipient's First Name</label>
                                <div class="field-widget">
                                        <input type="text" class="form-control" placeholder="First Name" name="name">
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>Recipient's Last Name</label>
                                    <div class="field-widget">
                                        <input type="text" class="form-control" placeholder="Last Name" name="name">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>What life decision are they making?<br> &nbsp;</label>
                                <div class="field-widget">
                                    <select class="Wide fancyselect1" name="buy_for" style="width:100%;">
                                        <?php echo Smart::selectList($life_decision, 'id', 'name', Smart::setValue('decision_id')); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>Which life decisions does this person seek your advice?</label>
                                    <div class="field-widget">
                                        <select class="Wide fancyselect1" name="buy_for" style="width:100%;">
                                        <?php echo Smart::selectList($life_decision, 'id', 'name', Smart::setValue('decision_id')); ?>
                                    </select>
                                    </div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>Select Credits to Purchase</label>
                            <div class="field-widget">
                                <select class="Wide fancyselect1">
                                    <option value="Country">1-Credit $99.99</option>
                                    <option value="AF">Canada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-field">
                                <label>What's Your Email Address?</label>
                                    <div class="field-widget">
                                        <input type="text" class="form-control" placeholder="Email" name="name">
                                    </div>  
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            
                                <h2 class="title-effect">Billing Info</h2>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>First Name*</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" placeholder="Your Name" name="name">
                            </div>  
                        </div> 
                        <div class="section-field col-md-6">
                            <label>Last Name*</label>
                            <div class="field-widget">
                                <input type="email" class="form-control" placeholder="Last Name" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <label>Address*</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" placeholder="Address" name="name">
                            </div>  
                        </div> 
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>Apt./Unit No</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" placeholder="Apt./Unit No" name="name">
                            </div>  
                        </div> 
                        <div class="section-field col-md-6">
                            <label>City*</label>
                            <div class="field-widget">
                                <input type="email" class="form-control" placeholder="City" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>Postal Code*</label>
                            <div class="field-widget">
                                <input type="email" class="form-control" placeholder="Postal Code" name="email">
                            </div>
                        </div>
                        <div class="section-field col-md-6">
                            <label>Select Province *</label>
                            <div class="field-widget">
                                <select class="Wide fancyselect1" >
                                    <option value="Country">Select Province</option>
                                    <option value="AF">Ontario</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>Select Country</label>
                            <div class="field-widget">
                                <select class="Wide fancyselect1">
                                    <option value="Country">Select Country</option>
                                    <option value="AF">Canada</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="section-title">
                                <h2 class="title-effect">Credits Info</h2>

                            </div>
                        </div>
                    </div>



                    
                    <div class="row">
                        <div class="section-field col-md-12">
                            <label>Card Holder Name*</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" placeholder="Card Holder Name" name="name">
                            </div>  
                        </div> 
                    </div>
                    <div class="row">
                        <div class="section-field col-md-12">
                            <label>Card Number*</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" placeholder="Card Number" name="name">
                            </div>  
                        </div> 
                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>Expiry Month</label>
                            <div class="field-widget">
                                <select class="Wide fancyselect1">
                                    <option value="Country">Select Month</option>
                                    <option value="AF">Canada</option>
                                </select>
                            </div>
                        </div>
                        <div class="section-field col-md-6">
                            <label>Expiry Year</label>
                            <div class="field-widget">
                                <select class="Wide fancyselect1">
                                    <option value="Country">Select Year</option>
                                    <option value="AF">Ontario</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="section-field col-md-6">
                            <label>CVV Code</label>
                            <div class="field-widget">
                                <input type="text" class="form-control" placeholder="Card Number" name="name">
                            </div>  
                        </div>

                    </div>
                </div>
                <a href="#" class="button mt-20">
                    <span>Process</span>
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>