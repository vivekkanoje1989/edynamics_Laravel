<?php
$uploads_dir = base_path() . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Monthly Invoice</title>
<style>
table{ border-collapse:collapse;} table td{ border-collapse:collapse;}
</style>
</head>
<body>
<table width="800" bgcolor="#fff" align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="border: 1px solid #000;font-size:12px;">
  <tbody>
    <tr>
      <td width="100%" height="10"></td>
    </tr>
    <tr>
      <td width="800">
      <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
          <tbody>
            <tr>
              <td width="100%" height="10"></td>
            </tr>
            <tr>
              <td width="800"><table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                  <tbody>
                     title 
                    
                    <tr>
                      <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Edynamics Business Services LLP</h4></td>
                    </tr>
                    <tr>
                      <td width="100%" height="10">&nbsp;</td>
                    </tr>
                     end of title 
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
           <?php if(!empty($modelEmail)){
    $billmonth = $modelEmail->from_date;
}else if(!empty($modelSMS)){
    $billmonth = $modelSMS->from_date;
} ?>
 <table width="800"  align="center"  cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
          <tbody>
            <tr>
              <td width="800"><table width="800"  cellspacing="0" cellpadding="0" border="0" >
                  <tbody>
                    <tr>
                      <td align="left" width="150"><img src="<?php echo $uploads_dir;?>logo.jpg" style="height: 65px;width: auto;"/></td>
                      <td align="center" width="500"><table width="500" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                           
                           <tr>
                            <td width="100%" height="10"></td>
                          </tr>
                          </tbody>
                        </table>
                         <table width="500" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr>
                              <td width="250" ><table width="250" cellpadding="5" cellspacing="0" border="0">
                                  <tbody>
                                    <tr>
                                    <td style="width:250px;text-align: left;"><strong>Invoice No&nbsp;:&nbsp; </strong> <?php echo $invoiceno;?> </td>
                                    </tr>
                                       <tr>
                                    <td  style="width:250px;text-align: left;"> <strong>Invoice Date&nbsp;:&nbsp; </strong><?php echo date('d/m/Y',strtotime($invoice_date)); ?></td>
                                    </tr>
                                  </tbody>
                                </table>
                              
                              </td>
                              
                              
                                  <td width="250" >
                                      <table width="250" cellpadding="5" cellspacing="0" border="0">
                                  <tbody>
                                    <tr>
                                    <td  style="width:250px;text-align: right;"><strong>Bill Month&nbsp;:&nbsp; </strong> <?php echo date('F Y',strtotime($billmonth)); ?></td>
                                    </tr>
                                       <tr>
                                    <td  style="width:250px;text-align: right;"><strong>Due Date&nbsp;:&nbsp;</strong><?php echo date('d/m/Y', strtotime($invoice_date. ' + 9 days')); ?></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td align="right" width="150">
                          <img src="<?php echo $uploads_dir;?>bms.png"  style="width: 120px;height: auto;"/><br>
                          <!--<img src="<?php echo $uploads_dir;?>Nextedge.png"  style="width: 120px;height: auto;"/>-->
                      </td>
                    </tr>
                    
                   
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
         
    <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px; ">
          <tbody>
            <tr>
              <td width="100%" height="10"></td>
            </tr>
            
              <tr>
              <td width="800">
              <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                  <tbody>
                     title 
                     <tr>
                      <td style="width: 325px;text-align: right;color: #000;padding-top: 5px;" valign="top">
                 ____________________________________________________________
                                          </td>                                        <td valign="top" style="width: 150px; text-align:center; padding:5px; border:1px solid #000; border-radius:15px!important;">Value Added Services<br/><span style="font-size:11px;"><b>Tax Invoice</b></span>
                                          </td>  
                      <td style="width: 325px;text-align: left;color: #000;padding-top: 5px;" valign="top">__________________________________________________________</td>
                    </tr>
            </tbody></table></td></tr>
            
            <tr>
              <td width="800">
              <table width="800" align="center" cellspacing="0" cellpadding="0" border="0">
                  <tbody>
                     title 
                  
                    <tr>
                      <td style="width: 200px;"><b>To&nbsp;,&nbsp;</b>
                                          </td>
                                         <td style="width: 400px;">&nbsp;&nbsp;
                                          </td>  
                      <td style="width: 200px;text-align:left;"><b>From&nbsp;,&nbsp;</b></td>
                    </tr>
                    <tr>
                      <td style="width:200px;" valign="top"><?php echo ucwords($client->office_address);?><br>
                                                                    <?php echo ucwords($client->city_name);
                                                                           echo ' '.ucwords($client->pin_code).' ,';?><br>
                                                                    <?php echo ucwords($client->state_name);?></td>
                          <td style="width: 400px;">&nbsp;&nbsp;
                                          </td>  
                                          
                      <td style="width: 200px;text-align: left;" valign="top"><?php echo ucwords($owndetails->marketing_name );?><br>
                                                                                
                                                                    <?php echo ucwords($owndetails->office_address);?><br>
                                                                    <?php echo ucwords($owndetails->cityList->name);
                                                                       echo ' '.ucwords($owndetails->pin_code).' ,';?><br>
                                                                    <?php echo ucwords($owndetails->stateList->name);?>
                        </td>
                        
                    </tr>
                    <tr>                <td style="width: 200px;"><b>GSTIN&nbsp;:&nbsp;<?php echo ucwords($client->gst_number);?></b>
                                          </td>  
                                          <td style="width: 200px;">&nbsp;&nbsp;
                                          </td>
                                              <td style="width: 200px;"><b>GSTIN&nbsp;:&nbsp;<?php echo ucwords($owndetails->gst_number);?></b>
                                          </td>  </tr>
                                            <tr>   <td style="width: 200px;"><b>State Code&nbsp;:&nbsp;<?php echo ucwords($client->state_code);?></b>
                                          </td>  
                                               <td style="width: 200px;">&nbsp;&nbsp;
                                          </td>
                                              <td style="width: 200px;"><b>PAN No.&nbsp;:&nbsp;<?php echo ucwords($owndetails->pan_number);?></b>
                                          </td>  </tr>
                    
                     end of title 
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
        
          <hr>
        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
          <tbody>
            <tr>
              <td width="100%" height="10"></td>
            </tr>
            <tr>
              <td width="800"><table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                  <tbody>
                     title 
                    
                    <tr>
                      <td  style="font-family: Helvetica,arial,sans-serif;font-size: 10px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Your Account Summary</h4></td>
                    </tr>
                    <tr>
                      <td width="100%" height="10">&nbsp;</td>
                    </tr>
                     end of title 
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
        
        
        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
          <tbody>
            <tr>
              <td width="100%" height="10"></td>
            </tr>
            <tr>
              <td width="800">
              <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                  <tbody>
                     title 
                    
                    <tr>
                      <td  style="width:145px; text-align:center; " width="145px">
                    <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Previous Balance</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;0</td>
                    </tr>
                    </table>
                      
                      </td> 
                         <td  style="width:15;text-align:center; border:none;"> &nbsp;-&nbsp;</td>   
                             <td  style="width:145px; text-align:center; " width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Last Payment</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;0</td>
                    </tr>
                    </table></td> 
                          <td  style="width:15;text-align:center"  width="25">&nbsp;=&nbsp;</td>    
                         <td  style="width:145px; text-align:center; " width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Balance</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;0</td>
                    </tr>
                    </table></td>
                        <td  style="width:15;text-align:center" width="25">&nbsp;+&nbsp;</td>    
                       <td  style="width:145px; text-align:center; " width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;This Month's Bill</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;&#8377; <?php echo $final_digit_ammount; ?></td>
                    </tr>
                    </table></td>
                       <td  style="width:15;text-align:center" width="25">&nbsp;=&nbsp;</td>
                   <td  style="width:145px; text-align:center;" width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                        <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp; Total Bill Amount</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;&#8377; <?php echo $final_digit_ammount; ?></td>
                    </tr>
                    </table></td>
                    </tr>
                    <tr>
                      <td colspan="8" width="100%" height="10">&nbsp;</td>
                    </tr>
                     
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
          
          <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>

                                <tr>
                                    <td width="800">
                                        <table width="800" style="font-size:14px;" align="center" cellspacing="0" cellpadding="3" border="0" >
                                            <tbody>
                                                 start 1 table 

                                                <tr style="background: #ececec; height: 35px;"  width="800">
                                                    
                                                    <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:270px;">
                                                        <b>Description</b>
                                                    </th>
                                                     <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:150px;">
                                                        <b>HSN/SAC</b>
                                                    </th>
                                                    <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Quantity</b>
                                                    </th>
                                                    
                                                    <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Rate</b>
                                                    </th>
                                                    <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Sub Total</b>
                                                    </th>
                                                    <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Discount</b>
                                                    </th>
                                                    <th style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Total</b>
                                                    </th>


                                                </tr>
                                                <?php
						$cnt=1;
						$total=0;
						$cnt_row=0;
						   
                                                if(!empty($modelSMS) && $modelSMS->amount > 0)    
                                                {
                                                  ?>
                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo ucwords($modelSMS->invoicefor).' '.SERVICE; ?>
                                                    </td>
                                                     <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelSMS->hsn_sac; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelSMS->quantity; ?>
                                                    </td>
                                                    
                                                    <td style="text-align:right;border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php 
										//$rate = $invoice->amount/$invoice->quantity;
										echo $modelSMS->rate;
										$total_amt=$modelSMS->amount; 
									?>
                                                    </td>
                                                    <td style="text-align:right;border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelSMS->amount; ?>
                                                    </td>
                                                
                                               <?php											
								if($modelSMS->servicetax > 0)
									$sub_total_with_servicetax+=round($modelSMS->amount);
								
							
                                                if(!empty($modelSMS->discount)){?>
                                                        
                                                    <td style="text-align:right;border: 1px solid #000;font-size: 12px;"><?php echo round($modelSMS->discount);?> </td>
                                                    
                                                 
                                                        <td style="text-align:right;border: 1px solid #000; border-collapse: collapse;font-size: 12px;"><?php 
                                                        $total_dis = round($modelSMS->amount-$modelSMS->discount); 
                                                        $total_amt= round($total_dis+$modelSMS->charges); 
                                                        $total_amtsms= $total_amt;
                                                        echo round($total_amt);
                                                         ?> </td>
                                                    
                                                   
                                                <?php }else{?>
                                                     <td style="text-align:right;border: 1px solid #000;font-size: 12px;">0</td>
                                                      <td style="text-align:right;border: 1px solid #000; border-collapse: collapse;font-size: 12px;"><?php echo $modelSMS->amount; ?> </td>
                                                <?php }
                                                $final_total +=$total_amt;
                                                    $total_tax+= $modelSMS->servicetax;
                                                $grand_total = $total_tax+$final_total;
                                                
                                                 
                                                 ?>
                                                    
                                                </tr>
                                               
                                                
                                                <?php } if(!empty($modelEmail) && $modelEmail->amount > 0)    
                                                {
                                                  ?>
                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo ucwords($modelEmail->invoicefor).' '.SERVICE; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelEmail->hsn_sac; ?>
                                                    </td>
                                                    
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelEmail->quantity; ?>
                                                    </td>
                                                    
                                                    <td style="text-align:right;border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php 
										//$rate = $invoice->amount/$invoice->quantity;
										echo $modelEmail->rate;
										$total_amt=$modelEmail->amount; 
									?>
                                                    </td>
                                                    <td style="text-align:right;border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelEmail->amount; ?>
                                                    </td>
                                                </tr>
                                               <?php											
								if($modelEmail->servicetax > 0)
									$sub_total_with_servicetax+=round($modelEmail->amount);
								
							
                                                if(!empty($modelEmail->discount)){?>
                                                        
                                                   
                                                            <td style="text-align:right;border: 1px solid #000;font-size: 12px;"><?php echo round($modelEmail->discount);?> </td>
                                                            <td style="text-align:right;border: 1px solid #000; border-collapse: collapse;font-size: 12px;"><?php 
                                                            $total_dis = round($modelEmail->amount-$modelEmail->discount); 
                                                            $total_amt= round($total_dis+$modelEmail->charges); 
                                                            $total_amtgmail= $total_amt; 
                                                            echo round($total_amt);
                                                             ?> </td>
                                                    </tr>
                                                <?php }else{ ?>
                                                    <td style="text-align:right;border: 1px solid #000;font-size: 12px;">0</td>
                                                            <td style="text-align:right;border: 1px solid #000; border-collapse: collapse;font-size: 12px;"><?php echo round($modelEmail->amount);?> </td>
                                                    
                                               <?php }
                                                $final_total +=$total_amt;
                                                }
                                                
                                                            ?>		
                                                              
                                                    
                                                    
                                                    
                                                <tr style="height: 35px;font-size:12px;width:100%;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000; border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px; ">
                                                        &nbsp;&nbsp; <b>Total</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo round($final_total);?> 
                                                    </td>


                                                </tr>
                                                                              
                                                
                                                <?php
                                                       $total_tax=round($final_total*(9)/100);
                                                 
                                               ?>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000;border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>CGST(9%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $total_tax;?>
                                                    </td>
                                                </tr>
                                                 
                                               <?php
                                                       $total_tax1=round($final_total*(9)/100);
                                                       $grand_total = $total_tax1+$total_tax+$final_total;
                                               ?>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000;border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>SGST(9%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $total_tax1;?>
                                                    </td>
                                                </tr>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>IGST(18%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; 0
                                                    </td>
                                                </tr>
                                               
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000;border-left:1px solid #000; border-collapse: collapse;text-align:left; font-size: 12px;">
                                                        &nbsp;&nbsp; <b>Amount due in INR </b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <b><?php  echo round($grand_total);?></b>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
          
          
            <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>

                                                <tr>
                                                    <td style="width: 800px;">
                                                        <p style="  margin: 0; height: 25px;width: 192px;display: inline-block;font-size:12px; font-weight: 600;"><b>Amount Payable (In word)</b>: Rupees <?php echo ucwords($final_invoice_ammount);    ?> Only</p>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td style="width: 800px; height: 5px;">
                                                        &nbsp;
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
         
          
                        <table width="800"  align="center" cellspacing="0" cellpadding="3" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="3" cellpadding="3" border="1" >
                                            <tbody>

                                                <tr>
                                                    <td rowspan="2" style="width:200px; text-align:left;font-weight: bold">
                                                        HSN
                                                    </td>
                                                    <td rowspan="2"  style="width:150px; text-align: center;font-weight: bold">Taxable Value</td>
                                                    <td colspan="2"  style="width:150px;font-weight: bold; text-align: center;">Central Tax</td>   
                                                            <td colspan="2" style="width:150px; text-align: center;font-weight: bold">State Tax</td>
                                                            <td colspan="2" style="width:150px; text-align: center;font-weight: bold">Integrated Tax</td>
                                                        
                                                </tr>
                                                <tr>
                                                        
                                                            <td style="width:75px; text-align: center;">Rate</td>
                                                
                                                <td style="width:75px; text-align: center;">Amount</td>
                                                        
                                                            <td  style="width:75px; text-align: center;">Rate</td>
                                                        
                                                            <td style="width:75px; text-align: center;">Amount</td>
                                                            <td style="width:75px; text-align: center;">Rate</td>
                                                        
                                                            <td style="width:75px; text-align: center;">Amount</td>
                                                        
                                                         
                                                </tr>
                                              <?php  if(!empty($modelSMS) && $modelSMS->amount > 0)  {  ?>
                                                <tr>
                                                    <td><?php echo $modelSMS->hsn_sac; ?></td>
                                                    <td style=" text-align: center;"><?php if(empty($total_amtsms)){ echo round($modelSMS->amount);}else{ echo $total_amtsms;};?></td>
                                                        
                                                            <td style="width:75px; text-align: center;"> (9%) </td>
                                                
                                                <td style="width:75px; text-align: center;"><?php  
                                                 if(empty($total_amtsms)){ $total_taxsms=round($modelSMS->amount*(9)/100);}else { $total_taxsms=round($total_amtsms*(9)/100); }
                                                 echo round($total_taxsms);?></td>
                                                        
                                                            <td  style="width:75px; text-align: center;"> (9%)</td>
                                                        
                                                            <td style="width:75px; text-align: center;"><?php  
                                                 if(empty($total_amtsms)){ $total_taxsms2=round($modelSMS->amount*(9)/100);}else { $total_taxsms2=round($total_amtsms*(9)/100); }
                                                 echo round($total_taxsms2);?></td>
                                                            <td style="width:75px; text-align: center;">(18%)</td>
                                                        
                                                            <td style="width:75px; text-align: center;">0</td>
                                                        
                                                         
                                                </tr>
                                                
                                              <?php } ?>
                                                 <?php  if(!empty($modelEmail) && $modelEmail->amount > 0)  {  ?>
                                                <tr>
                                                    <td><?php echo $modelEmail->hsn_sac; ?></td>
                                                    <td style=" text-align: center;"><?php if(empty($total_amtgmail)){ echo round($modelEmail->amount) ;}else {echo $total_amtgmail;}?></td>
                                                        
                                                            <td style="width:75px; text-align: center;"> (9%) </td>
                                                
                                                <td style="width:75px; text-align: center;"><?php 
                                                    if(empty($total_amtgmail)){ $total_taxemail=round($modelEmail->amount*(9)/100);}else { $total_taxemail=round($total_amtgmail*(9)/100); }
                                                                                        echo round($total_taxemail);?></td>
                                                        
                                                            <td  style="width:75px; text-align: center;"> (9%)</td>
                                                        
                                                            <td style="width:75px; text-align: center;"><?php 
                                                    if(empty($total_amtgmail)){ $total_taxemail2=round($modelEmail->amount*(9)/100);}else { $total_taxemail2=round($total_amtgmail*(9)/100); }
                                                                                        echo round($total_taxemail2);?></td>
                                                            <td style="width:75px; text-align: center;">(18%)</td>
                                                        
                                                            <td style="width:75px; text-align: center;">0</td>
                                                        
                                                         
                                                </tr>
                                                
                                              <?php } ?>
                                                <tr>
                                                        <td style=" text-align: right; font-weight: bold">Total</td>
                                                        <td style=" text-align: center;font-weight: bold"><?php echo round($final_total);?> </td>

                                                        <td style="width:75px; text-align: center;">&nbsp;</td>
                                                
                                                <td style="width:75px; text-align: center;font-weight: bold"><?php echo $total_tax;?></td>
                                                        
                                                            <td  style="width:75px; text-align: center;">&nbsp;</td>
                                                        
                                                            <td style="width:75px; text-align: center;font-weight: bold"><?php echo $total_tax1;?></td>
                                                            <td style="width:75px; text-align: center;">&nbsp;</td>
                                                        
                                                            <td style="width:75px; text-align: center;font-weight: bold">0</td>
                                                        
                                                         
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
          <?php  if(!empty($modelEmail->discount) || !empty($modelSMS->discount)){?>
                    <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>

                                                <tr>
                                                    <td style="width: 800px;">
                                                        <p style="margin: 0; height: 25px;width: 192px;display: inline-block;font-size:10px; font-weight: bold;">Discount Description</p>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
          
          
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <tr>
                                                    <td  style="font-size:10px;width: 800px;">
                                                        <ul>
                                                          <?php if(!empty($modelEmail->discount)){?>  <li> <?php echo 'Discount for LMS' .$modelEmail->discount_for.' ( Rs. '. $modelEmail->discount . ' - '. $modelEmail->quantity. ' G Suit ID )';  } ?> </li>
                                                          <?php if(!empty($modelSMS->discount)){ ?> <li> <?php echo 'Discount for LMS' .$modelSMS->discount_for.' ( Rs. '. $modelSMS->discount . ' - Qty. '. $modelSMS->quantity. ' SMS )';  } ?> </li>
                                                        </ul>	
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td style="height:10px;">&nbsp;</td></tr>
                            </tbody>
                        </table>
          
          <?php } ?>
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <tr>
                                                     <td style="width: 800px; height: 5px;">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 800px; height: 5px;">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td style="width: 800px; height: 5px;">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 800px;">
                                                        <p style=" margin: 0; height: 25px;width: 192px;display: inline-block;font-size:8px; font-weight: 600;">Terms & Conditions</p>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
          
          
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 8px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <tr>
                                                    <td  style="font-size:8px;width: 800px;">
                                                        <ul>
                                                            <li> Training's & Technical backup would be provided online, telephonic or personally as per needed by the sole direction of Edynamics Business Services LLP.</li>
                                                            <li> Data security will be applicable as per cloud services policy.</li>
                                                            <li> All above amounts are inclusive of Taxes.</li>
                                                            <li> Purchase Order and all Payments should be made in the name of "Edynamics Business Services LLP".</li>
                                                            <li> Terms & conditions * of the services are applicable as mentioned on www.edynamics.co.in.</li>
                                                        </ul>	
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table width="800"  align="center"  cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="599">
                                        <table width="100%" align="left  "cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>												
                                                <tr>
                                                     <td style="width:299px;" style="border-right:1px solid #000">
                                                        <ul>
                                                            Kindly pay by cheque / DD in favor of <b> Edynamics Business Services LLP. </b> payable at<br>
                                                            <b>PUNE</b> immediately on receipt of this invoice<br>
                                                            <b>Bank Name</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->bank_name);?>,&nbsp;&nbsp;<b>Branch Name</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->branch_name);?> <br>
                                                            <b>Account Type</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->accountlist->account_type);?>,&nbsp;&nbsp;<b>Account No.</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->account_no);?> <br>
                                                            <b>IFSC Code</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->ifsc_code);?>,&nbsp;&nbsp;<b>MICR Code</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->micr_code);?> <br>
                                                            <b>Corporate No.</b>&nbsp;:&nbsp;+91 - 9595 01 80 00
                                                        </ul>
                                                    </td>												
                                                </tr>										
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="200">
                                        <table width="100%" align="right" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <tr><td style="width: 200px;" align="center">For Edynamics Business Services LLP</td></tr>
                                                <tr>
                                                    
                                                    <td style="width:200px;" align="center">
                                                        <img src="<?php echo $uploads_dir;?>stamp.png" style="width:100px;height:auto;margin-bottom: 12px;">
                                                    </td>												
                                                </tr>	
                                                 <tr><td style="width: 200px;" align="center">Authorised Signatory</td></tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
        
        
        </td>
    </tr>
  </tbody>
</table>
</body>
</html>