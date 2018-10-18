<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "List Of Questions", "txt3" => "")); ?>
    <div class="container form-margin">
        <div class="row mt-10">
            <div class="col-sm-12">  
                <?php
                if (count($list) > 0):
                    $i = 1;
                    ?>
                    <?php echo Smart::softErrors(); ?>
                <?php echo Smart::formErrors(); ?>

                <?php echo form_open(base_url('update-ordering')); ?>
                <input name="uri" value="<?php echo $uri;?>" type="hidden">
                    <div class="table-responsive">
                        <table class="table table-1 table-bordered table-striped" data-filter="#filter" data-page-size="5">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th style="text-align:left; padding-left: 10px;">
                                        Order
                                    </th>
                                    <th style="text-align:left; padding-left: 10px;">
                                        Caption
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list as $row):
                                    ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><input type="number" class="form-control" style="width: 100px;" name="order_<?php echo $row->id?>" value="<?php echo $row->display_order?>"></td>
                                        <input type="hidden" name="ord[]" value="<?php echo $row->id?>">
                                        <td style="text-align:left; padding-left: 10px;"><?php echo Smart::echoString($row->name); ?></td>
                                    </tr>

                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                            <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <button class="btn btn-blue" type="submit">Update Order</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                
                <?php echo form_close(); ?>
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

