<html>
    <?php
    $order_req = json_decode($order_details);
    ?>
    <head>
        <title>::HAG E-MAIL::</title>
    </head>
    <body style="font-family:Arial;"> 
        <div class="wrapper" style="width:100%;height:100%;"><!--wrapper end-->
            <div class="main" style="width:650px;height:auto;min-height:90;margin:0 auto;background:#c92c33;border:2px solid #c92c33;"><!--main start--> 
                <div style="width:650px;height:90px;background:#fff;text-align:center;">
                    <a href="<?php echo base_url(); ?>" style="text-decoration:none;text-align:center;"><img src="<?php echo LOGO_PATH; ?>" alt="logo" title="logo" style="width:158px;height:86px;"/></a></div><!--header end-->
                <div style="width:600px;height:auto;min-height:448px;margin:0 auto;">
                    <?php if ($order_req->code == SUCCESS_CODE) { 
                        $order_response=$order_req->order_result;
                        ?>
                        <table style="width:100%;margin:2px auto;background:#FFF;padding: 10px;">       
                            <tbody>        
                                <tr>            
                                    <td><h4 style="font-weight: 600;margin: 0px;line-height: 30px;">Dear <?php echo fetch_ucwords($order_response->username); ?>,</h4></td>
                                    <td></td>
                                </tr>       
                                <tr style="font-size:14px;">           
                                    <td  width="50%" style="color:green;font-weight:600" >Your order has been placed successfully,</td>   
                                </tr>
                                <tr  style="text-indent:5px;">
                                    <td>Shipping Details</td>
                                </tr>
                                <tr  style="text-indent:5px;">
                                    <td>Name:- <?php echo fetch_ucwords($order_response->username); ?></td>
                                    <td width="30%"height="50" style="font-size:14px;">Order ID:<?php echo fetch_ucwords($order_response->ordernumber); ?> </td>
                                  
                                </tr>
                                <tr>
                                    <td  style="text-indent:5px;">Mobile:- <?php echo fetch_ucwords($order_response->mobile); ?></td>
                                    <td>Order Price: Rs. <?php echo fetch_ucwords($order_response->order_total); ?> /-</td>
                                </tr>
                                <tr>
                                    <td height="50%">Address : <?php echo fetch_ucfirst($order_response->address);?></td>
                                    <td>Order Date:<?php echo date('d-M-Y H:i A',  strtotime($order_response->order_created_date)); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Land Mark : <?php echo fetch_ucfirst($order_response->landmark);?><br/>
                                        City : <?php echo fetch_ucfirst($order_response->city);?><br/>
                                        Country : <?php echo fetch_ucfirst($order_response->country);?><br/>
                                        Pincode : <?php echo fetch_ucfirst($order_response->pincode);?><br/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr style="text-indent:5px;">
                                    <td>Image</td>
                                    <td>Title</td>
                                    <td>Qty</td>
                                    <td width="200" align="center">Price</td>            
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <?php
                                if(count($order_req->order_products) > 0){
                                    
                                foreach($order_req->order_products as $products){
                                ?>
                                <tr style="text-indent:5px;">
                                    <td><img src="<?php echo fetch_ucwords($products->artimage); ?>" style="height:60px;"/></td>
                                    <td><?php echo fetch_ucwords($products->productname); ?></td>           
                                    <td><?php echo fetch_ucwords($products->cartqty); ?></td>
                                    <td width="200" align="center">Rs . <?php echo fetch_ucwords($products->cartprice); ?> /-</td>
                                </tr>

                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <?php } } ?>
                                
                              
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td width="200" align="center">Total&nbsp;:&nbsp;Rs. <?php echo fetch_ucwords($order_response->order_total); ?> /-</td>
                                </tr>
                                <tr>       
                                    <td style="text-indent:20px;">Thanks & Regards </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>       
                                </tr>
                                <tr style="text-indent:20px;">       
                                    <td>hag,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>       
                                </tr>
                            </tbody>
                            <tfoot line-height:"30px">
                                   <tr><td  align="right"><a href="#" style="text-decoration:none;color:#222;">hag@gmail.com</a></td></tr>
                            </tfoot>      
                        </table>
                    <?php } ?>
                </div><!--container end--> 
                <table>        
            </div><!--main end-->
        </div><!--wrapper end-->
    </body>
</html>