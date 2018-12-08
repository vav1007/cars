<?php $this->load->view(SELLER_EMAIL_TEMPLATE_PATH.'template_header'); ?>
    <div id='bodydiv' style='padding:15px;background:rgba(238, 238, 238, 0.18);'>
        <p style='margin:0px;color:#8d8d8d;line-height:25px;'>Dear Customer,</p>
        <p style='margin:0px;color:#8d8d8d;line-height:25px;'>Greetings! ,</p>
        <div style='width:100%;height:auto;min-height:30px;padding:5px 0px 10px;'>
            
            <div style='width:500px;height:auto;min-height:30px;float:left;padding:8px 0px 7px;'>
                <table style='font-size:14px;'>
                    <tr>	
                        <td>
                            <p><?php echo $description;?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div style='clear:both;margin:0px;padding:0px;'></div>
        </div>
        <div style='clear:both;margin:0px;padding:0px;'></div>
        <div style='text-align:center;width:100%;'>
            <p style='color:#DF3A01;margin:0px;'></p>
        </div>
        <div style='clear:both;margin:0px;padding:0px;'></div>
    </div>
    <?php $this->load->view(SELLER_EMAIL_TEMPLATE_PATH.'template_footer'); ?>
