<?php $this->load->view('emails/header', $header); ?>
<table width="100%" cell cellspacing="0" border="0">
    <tr><td height="30" width="100%" class="mobile-td" style="font-family:'Open Sans',Arial, Sans-Serif; font-size: 8pt; text-align:right; color:#777777; line-height:22px; padding-right:30px; padding-left:30px;" valign="middle">
            <p>Date: <?php Smart::echoString(Smart::localeDateTime()); ?></p>
        </td></tr>	
    <tr><td height="30" width="100%" class="mobile-td" style="padding-right:30px; padding-left:30px; padding-top:20px;" valign="middle">
            <h1 style="font-family:'Open Sans Condensed',Arial, Sans-Serif; font-size: 22px; font-weight: 700; text-align:left; color:#666; padding: 0px;"><?php Smart::echoString($heading); ?></h1>
        </td></tr>						
    <tr><td width="100%" class="mobile-td" style="color:#363636; font-family:'Open Sans',Arial, Sans-Serif; font-size: 14px; font-weight: 400;line-height:22px; text-align:left;padding-left:30px; padding-right:30px; padding-top:10px; padding-bottom:10px;" valign="middle">

            <?php
            if (is_object($customer)) {
                echo Lang('hi') . " " . Smart::string($customer->first_name) . ",<br><br>";
            }
            ?>
            <?php echo $message; ?>                    
        </td></tr>
    <tr>
        <td style="color:#363636; font-family:'Open Sans',Arial, Sans-Serif; font-size: 14px; font-weight: 600; text-align:left; line-height:22px; padding:30px;">
            <?php echo Lang('email_thanks'); ?>
            <?php
            if (!empty($activation)):
                ?>
                <img src="<?php echo $activation ?>">
            <?php endif; ?>
        </td>
    </tr>
</table>
<?php $this->load->view('emails/footer', $footer); ?>