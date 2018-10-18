<?php echo Smart::makeNavigation('/', 'Home'); ?>
<li class="hoverTrigger"><a href="<?php echo base_url('life-decision');?>">Risk Calculator</a></li>
<li class="hoverTrigger"><a href="<?php echo base_url('advisors')?>">Advisors</a></li>
<li class="hoverTrigger"><a href="<?php echo base_url('lawyers')?>">Lawyers</a></li>
<li class="hoverTrigger"><a href="<?php echo base_url('professions')?>">By Profession</a></li>
<li class="hoverTrigger"><a href="<?php echo base_url('wedding-gifts')?>">Wedding Gifts</a></li>

<?php
if (Smart::isAuthorized() === FALSE) {
    echo Smart::makeNavigation('sign-in', 'Sign In');
}
    