<?php $this->load->view(FRONT_EMAIL_TEMPLATE_PATH . 'template_header'); ?>
<div id='bodydiv' style='padding:15px;background:rgba(238, 238, 238, 0.18);'>
    <b>Enquiry details,</b>
    <div style='width:100%;height:auto;min-height:30px;padding:5px 0px 10px;'>
        <table>
            <tr><td>Name</td><td>:</td><td><?php echo $enquiery_details['name']; ?></td></tr>
            <tr><td>Email</td><td>:</td><td><?php echo $enquiery_details['email']; ?></td></tr>
            <tr><td>Mobile</td><td>:</td><td><?php echo $enquiery_details['mobile']; ?></td></tr>
            <tr><td>Description</td><td>:</td><td><?php echo $enquiery_details['description']; ?></td></tr>
            <tr><td>Art Name</td><td>:</td><td><?php echo $enquiery_details['art_name']; ?></td></tr>
            <tr><td>Art Code</td><td>:</td><td><?php echo $enquiery_details['art_code']; ?></td></tr>
             <tr><td>Art SKU Code</td><td>:</td><td><?php echo $enquiery_details['art_sku_code']; ?></td></tr>
              <tr><td>Enquiry Date</td><td>:</td><td><?php echo date('d-M-Y h:i a');?></td></tr>
        </table>
    </div>
    <div style='clear:both;margin:0px;padding:0px;'></div>
    <div style='text-align:center;width:100%;'>
        <p style='color:#DF3A01;margin:0px;'></p>
    </div>
    <div style='clear:both;margin:0px;padding:0px;'></div>
</div>
<?php $this->load->view(FRONT_EMAIL_TEMPLATE_PATH . 'template_footer'); ?>