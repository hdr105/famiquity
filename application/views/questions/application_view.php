<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "My Application", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="register-form" class="register-form">
                    <div class="table-responsive">
                        <table class="table b-t">
                            <tbody>
                                    <tr>
                                        <td><label>First Name</label></td>
                                        <td><?php Smart::echoString($application->completion_date);?></td>
                                    </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>

</section>