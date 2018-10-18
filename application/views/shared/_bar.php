<?php
/* <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage; ?>%</div>
  </div> */
$array = array(
    "0" => array("url" => base_url('confide'), "css" => 'current'),
    "1" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "2" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "3" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "4" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "5" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
    "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
);

switch ((int) $level) {
    case 1:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'current'),
            "1" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "2" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "3" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "4" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "5" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 2:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'current'),
            "2" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "3" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "4" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "5" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 3:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'current'),
            "3" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "4" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "5" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 4:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'completed'),
            "3" => array("url" => base_url('spouse-info'), "css" => 'current'),
            "4" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "5" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 5:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'completed'),
            "3" => array("url" => base_url('spouse-info'), "css" => 'completed'),
            "4" => array("url" => base_url('business-tax-info'), "css" => 'current'),
            "5" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 6:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'completed'),
            "3" => array("url" => base_url('spouse-info'), "css" => 'completed'),
            "4" => array("url" => base_url('business-tax-info'), "css" => 'completed'),
            "5" => array("url" => base_url('shift-work'), "css" => 'current'),
            "6" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 7:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'completed'),
            "3" => array("url" => base_url('spouse-info'), "css" => 'completed'),
            "4" => array("url" => base_url('business-tax-info'), "css" => 'completed'),
            "5" => array("url" => base_url('shift-work'), "css" => 'completed'),
            "6" => array("url" => base_url('shift-work'), "css" => 'current'),
            "7" => array("url" => "javascript:void(0)", "css" => 'queue'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 8:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'completed'),
            "3" => array("url" => base_url('spouse-info'), "css" => 'completed'),
            "4" => array("url" => base_url('business-tax-info'), "css" => 'completed'),
            "5" => array("url" => base_url('shift-work'), "css" => 'completed'),
            "6" => array("url" => base_url('assets-info'), "css" => 'completed'),
            "7" => array("url" => base_url('personal-loans'), "css" => 'current'),
            "8" => array("url" => "javascript:void(0)", "css" => 'queue'),
        );
        break;
    case 9:
        $array = array(
            "0" => array("url" => base_url('confide'), "css" => 'completed'),
            "1" => array("url" => base_url('income-info'), "css" => 'completed'),
            "2" => array("url" => base_url('kids-basic-info'), "css" => 'completed'),
            "3" => array("url" => base_url('spouse-info'), "css" => 'completed'),
            "4" => array("url" => base_url('business-tax-info'), "css" => 'completed'),
            "5" => array("url" => base_url('shift-work'), "css" => 'completed'),
            "6" => array("url" => base_url('assets-info'), "css" => 'completed'),
            "7" => array("url" => base_url('personal-loans'), "css" => 'completed'),
            "8" => array("url" => base_url('financial-solution'), "css" => 'current'),
        );
        break;
}
if((int)$level > 0):
    $numKids = (int)$this->session->numKids;
?>
<div class="row">
    <div class="col-sm-12">
        <ul class="app_events">
            <li><a href="<?php echo base_url('confide'); ?>" class="<?php echo $array[0]['css'] ?>">Personal Info</a></li>
            <li><a href="<?php echo base_url('income-info'); ?>" class="<?php echo $array[1]['css'] ?>">Financial Info</a></li>
            <?php if($numKids > 0):?>
            <li><a href="<?php echo base_url('kids-info'); ?>" class="<?php echo $array[2]['css'] ?>">Kids Info</a></li>
            <?php endif;?>
            <li><a href="<?php echo base_url('spouse-info'); ?>" class="<?php echo $array[3]['css'] ?>">Partner Info</a></li>
            <li><a href="<?php echo base_url('business-tax-info'); ?>" class="<?php echo $array[4]['css'] ?>">Income</a></li>
            <li><a href="<?php echo base_url('shift-work'); ?>" class="<?php echo $array[5]['css'] ?>">Relationship</a></li>
            <li><a href="<?php echo base_url('assets-info'); ?>" class="<?php echo $array[6]['css'] ?>">Assets</a></li>
            <li><a href="<?php echo base_url('personal-loans'); ?>" class="<?php echo $array[7]['css'] ?>">Liabilities</a></li>
            <li><a href="<?php echo base_url('financial-solution'); ?>" class="<?php echo $array[8]['css'] ?>">Financial Solution</a></li>
        </ul>
    </div>
</div>
<?php endif;?>
<br> 
