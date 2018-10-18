<?php $this->load->view('shared/_page_banner_empty'); ?>
<section class="gray-bg page-section-ptb o-hidden">
    <?php $this->load->view('shared/_page_header', array("txt1" => "", "txt2" => "My Applications", "txt3" => "")); ?>
    <div class="container form-margin">
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
                                        Life Decision
                                    </th>
                                    <th>
                                        Start Date
                                    </th>
                                    <th>
                                        Completion Date
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
                                        <td>
                                            <?php if ((int) $row->status === 0): ?>
                                                <a href="<?php echo base_url('restart-application/' . $row->id) ?>"><i class="fa fa-pencil-square"></i> Restart</a>
                                            <?php else:?>
                                                <a href="<?php echo base_url('view-application/' . $row->id) ?>"><i class="fa fa-eye"></i> view</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php Smart::echoString($row->name); ?></td>
                                        <td><?php echo Smart::formatDate($row->start_date); ?></td>
                                        <td><?php echo (strlen($row->completion_date) > 1) ? Smart::formatDate($row->completion_date) : ''; ?></td>
                                        <td><?php echo Smart::echoString(Constants::getAppStatusLabel($row->status)); ?></td>
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
                                            <?php //echo $links;?>
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
                        <b>You haven't done assessment yet.</b>
                        <hr>
                        <a href="<?php echo base_url('life-decision')?>" class="btn btn-lg btn-primary">Start Assessment</a>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

