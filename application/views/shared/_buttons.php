
<div class="row mt-20">
    <div class="col-md-6"><button id="save" name="save" class="btn btn-lg btn-custom"><i class="fa fa-save"></i> <span>Next</span></button></div>
    <div class="col-md-6 text-right">
        <?php if (strlen($prev_page) > 2): ?>
            <a href="<?php echo base_url($prev_page); ?>" class="btn btn-lg btn-warning"><i class="fa fa-arrow-left"></i> Previous</a>
            <?php
        endif;
        if (strlen($next_page) > 2):
            ?>
            <a href="<?php echo base_url($next_page); ?>" class="btn btn-lg btn-warning">Skip <i class="fa fa-arrow-right"></i></a>
            <?php
        endif;
        if ($show_assessment === TRUE):
            ?>
            <a href="<?php echo base_url('risk-report'); ?>" class="btn btn-lg btn-info">Get Free Report</a>
   
        <?php endif; ?>
    </div>
</div>