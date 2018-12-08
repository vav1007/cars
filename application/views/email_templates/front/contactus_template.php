<?php $this->load->view(FRONT_EMAIL_TEMPLATE_PATH . 'template_header'); ?>
<div id='bodydiv' style='padding:15px;background:rgba(238, 238, 238, 0.18);'>
    <p style='margin:0px;color:#8d8d8d;line-height:25px;'>Dear admin,</p>
    <p style='margin:0px;color:#8d8d8d;line-height:25px;'>Greetings! ,</p>
    <p style='margin:0px;color:#8d8d8d;line-height:25px;'><?php echo $name; ?> ,</p>
    <div style='width:100%;height:auto;min-height:30px;padding:5px 0px 10px;'>
        <div style='width:500px;height:auto;min-height:30px;float:left;padding:8px 0px 7px;'>
            <p style='font-size:12px;'>You have a mail from a viewer named <?php echo $name; ?> regarding the message shown below..</p>
            <p style='font-size:12px;'>
                
            </p>
        </div>
        <div style='clear:both;margin:0px;padding:0px;'></div>
    </div>
    <div style='clear:both;margin:0px;padding:0px;'></div>
    <div style='text-align:center;width:100%;'>
        <p style='color:#DF3A01;margin:0px;'></p>
    </div>
    <div style='clear:both;margin:0px;padding:0px;'></div>
</div>
<?php $this->load->view(FRONT_EMAIL_TEMPLATE_PATH . 'template_footer'); ?>