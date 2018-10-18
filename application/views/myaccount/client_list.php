<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Clients List", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-sm-12">   
                
                <?php echo Smart::softErrors(); ?>
                <?php echo Smart::formErrors(); ?>

                <?php echo form_open(base_url('list-client'), array("METHOD" => "GET")); ?>

                <div class="form-group">
                    <label>Client Name / Email</label>
                    <input id="login-username" type="text" class="form-control" 
                           name="user" value="<?php echo $this->input->get('user', TRUE) ?>">
                </div>

                <button class="btn btn-blue" type="submit">Search</button>
                <?php echo form_close(); ?>


            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">  
                <?php
                if (count($list) > 0):
                    $i = 1;
                    ?>

                    <div class="table-responsive mt-10">
                        <table class="table table-1 table-bordered table-striped" data-filter="#filter" data-page-size="5">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($list as $row):
                                ?>
                                
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo Smart::echoString($row->first_name . " " . $row->last_name); ?></td>
                                        <td><?php echo Smart::echoString($row->email); ?></td>
                                        <td><?php echo Smart::echoString($row->city); ?></td>
                                        <td><?php echo Smart::echoString(Constants::getRegisterStatusLabel($row->active)); ?></td>
                                    </tr>
                                
                                <?php
                                $i++;
                            endforeach;
                            ?>
                                    </tbody>
                            <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <ul class="pagination">
                                            <?php echo $links;?>
                                        </ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php
                else:
                ?>
                <div class="table-responsive">
                    <hr>
                    <b>No Record Found!</b>
                </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

