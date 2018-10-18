<?php $this->load->view('shared/_page_banner', array("heading" => "Institute List", "desc" => "list", "image" => Smart::loadImages('bg/02.jpg'))); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "Institute List", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row">
            <div class="col-sm-12">   
                
                <?php echo Smart::softErrors(); ?>
                <?php echo Smart::formErrors(); ?>

                <?php echo form_open(base_url('list-users'), array("METHOD" => "GET")); ?>

                <div class="form-group">
                    <label>User Name / Email</label>
                    <input id="login-username" type="text" class="form-control" 
                           name="name" value="<?php echo $this->input->get('name', TRUE) ?>">
                </div>

                <button class="button white" type="submit">Search</button>
                <a href="<?php echo base_url('add-institute');?>" class="button">Add Institute</a>
                <?php echo form_close(); ?>


            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">  
                <?php
                if (count($list) > 0):
                    $i = 1;
                    ?>

                    <div class="table-responsive">
                        <table class="table table-striped b-t" data-filter="#filter" data-page-size="5">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Contact Person
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($list as $row):
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a href="<?php echo base_url('edit-institute/' . $row->id) ?>"><i class="fa fa-pencil-square"></i> Edit</td>
                                        <td><?php echo Smart::echoString($row->name ); ?></td>
                                        <td><?php echo Smart::echoString($row->contact_person); ?></td>
                                        <td><?php echo Smart::echoString($row->phone); ?></td>
                                        <td><?php echo Smart::echoString($row->email); ?></td>
                                        <td><?php echo Smart::echoString(Constants::getStatusLabel($row->status)); ?></td>
                                    </tr>
                                </tbody>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                            <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="6" class="text-center">
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

