<?php
$this->load->view('shared/_basic_nav');
$user = Smart::getCurrentUser();
$name = explode(" ", $user->first_name);
$first_name = substr($name[0], 0, 10);
?>
<li class="hoverTrigger"><a href="javascript:void(0)" style="margin-left: 10px;"><i class="fa fa-user"></i> <?php echo $first_name;?>
        <div class="mobileTriggerButton"></div></a>
    <ul class="drop-down-multilevel effect-expand-top" style="transition: all 400ms ease;">
        <?php echo Smart::makeNavigation('import-clients', 'Add Clients'); ?>
        <?php echo Smart::makeNavigation('list-client', 'Clients List'); ?>
        <?php echo Smart::makeNavigationDivider();?>
        <?php echo Smart::makeNavigation('change-password', 'Change Password'); ?>
        <?php echo Smart::makeNavigation('sign-out', 'Sign Out'); ?>
    </ul>
</li>
