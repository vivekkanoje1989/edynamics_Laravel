<?php
$uploads_dir = base_path() . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Monthly Invoice</title>

    </head>
    <body>
        <table bgcolor="#fff" align="center" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="border: 1px solid #000;font-size:12px;">
            <tbody>

                <tr>
                    <td width="100%">
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="100%" height="10"></td>
                                </tr>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <!-- title -->

                                                <tr>
                                                    <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;">
                                                        <h4 style="margin: 0;">Customer Invoice</h4>
                                                    </td>
                                                </tr>

                                                <tr>
                                                        <td width="100%" height="10">&nbsp;</td>
                                                </tr>
                                                <!-- end of title -->
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table width="800"  align="" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>

                                <tr>
                                    <td width="800">
                                        <table width="800"  cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <tr>
                                                    <td align="left" width="600">
                                                        <img src="<?php echo $uploads_dir;?>logo.png" style="height: 65px;width: auto;"/>
                                                    </td>
                                                  
                                                    <td align="right" width="200">
                                                        <img src="<?php echo $uploads_dir;?>google.png" style="width: 140px;height: auto;"/>
                                                    </td>
                                                </tr>

                                                <!-- end of title -->
                                            </tbody>
                                        </table>
                                    </td>
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
                                                <!-- title -->

                                                <tr>
                                                    <td style="width: 400px;">
                                                        <b>Invoice Number&nbsp;:&nbsp;</b> <?php 
                                                            echo $invoiceno;
							?> 
                                                    </td>
<?php if(!empty($modelEmail)){
    $billmonth = $modelEmail->from_date;
}else if(!empty($modelSMS)){
    $billmonth = $modelSMS->from_date;
} ?>
                                                    <td style="width: 400px;text-align: right;">
                                                        <b>Bill Month&nbsp;:&nbsp;</b><?php echo date('M Y',strtotime($billmonth)); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 400px;"><b>Date&nbsp;:&nbsp;</b><?php echo date('d-m-Y',strtotime($invoice_date)); ?></td>
                                                    <td style="width: 400px;text-align: right;">
                                                        <b>Due Date&nbsp;:&nbsp;</b><?php echo date('d-m-Y', strtotime($invoice_date. ' + 5 days')); ?>
                                                    </td>
                                                </tr>

                                                <!-- end of title -->
                                            </tbody>
                                        </table>
                                    </td>
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
                                                <!-- title -->

                                                <tr>
                                                    <td style="width: 370px;background: #ececec; padding: 5px;border-bottom: 1px solid #ccc;text-align: center;">
                                                        <b>To&nbsp;:&nbsp; <?php echo ucwords( $client->marketing_name );?></b>
                                                    </td>
                                                    <td style="width:60px;">
                                                        &nbsp;
                                                    </td>
                                                    <td style="width: 370px;background: #ececec; padding: 5px;border-bottom: 1px solid #ccc;text-align: center;">
                                                        <b>From&nbsp;:&nbsp; <?php echo ucwords($owndetails->marketing_name );?></b>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td style="width:370px;" height="10">&nbsp;</td>
                                                    <td style="width:60px;" height="10">&nbsp;</td>
                                                    <td style="width: 370px;" height="10">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 370px;">
                                                        <p>    
                                                                       <?php echo ucwords($client->legal_name);?><br>
                                                                    <?php echo ucwords($client->office_addres);?><br>
                                                                    <?php echo ucwords($client->cityList->name);
                                                                           echo ' '.ucwords($client->pin_code).' ,';?><br>
                                                                    <?php echo ucwords($client->stateList->name);?>
                                                        </p>
                                                    </td>
                                                    <td style="width:60px;">
                                                        &nbsp;
                                                    </td>
                                                    <td style="width: 370px;">
                                                        <p>
                                                            <?php echo ucwords($owndetails->legal_name);?><br>
                                                                    <?php echo ucwords($owndetails->office_addres);?><br>
                                                                    <?php echo ucwords($owndetails->cityList->name);
                                                                       echo ' '.ucwords($owndetails->pin_code).' ,';?><br>
                                                                    <?php echo ucwords($owndetails->stateList->name);?>
                                                            
                                                        </p>
                                                    </td>


                                                </tr>

                                                <!-- end of title -->
                                            </tbody>
                                        </table>
                                    </td>
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
                                                <!-- title -->
                                                <tr>
                                                    <td style="height:5px;">&nbsp;</td>
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
                                        <table width="800" style="font-size:14px;" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <!-- start 1 table -->

                                                <tr style="background: #ececec; height: 35px;"  width="800">
                                                    
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:270px;">
                                                        <b>Description</b>
                                                    </th>
                                                     <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:150px;">
                                                        <b>HSN/SAC</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Quantity</b>
                                                    </th>
                                                    
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Rate</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Sub Total</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Discount</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
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
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo ucwords($modelSMS->invoicefor).' '.SERVICE; ?>
                                                    </td>
                                                     <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelSMS->hsn_sac; ?>
                                                    </td>
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelSMS->quantity; ?>
                                                    </td>
                                                    
                                                    <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php 
										//$rate = $invoice->amount/$invoice->quantity;
										echo $modelSMS->rate;
										$total_amt=$modelSMS->amount; 
									?>
                                                    </td>
                                                    <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelSMS->amount; ?>
                                                    </td>
                                                
                                               <?php											
								if($modelSMS->servicetax > 0)
									$sub_total_with_servicetax+=round($modelSMS->amount);
								
							
                                                if(!empty($modelSMS->discount)){?>
                                                        
                                                    <td style="text-align:right;border: 1px solid #ccc;font-size: 12px;"><?php echo round($modelSMS->discount);?> </td>
                                                    
                                                 
                                                        <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php 
                                                        $total_dis = round($modelSMS->amount-$modelSMS->discount); 
                                                        $total_amt= round($total_dis+$modelSMS->charges); 
                                                        echo round($total_amt);
                                                         ?> </td>
                                                    
                                                   
                                                <?php }else{?>
                                                     <td style="text-align:right;border: 1px solid #ccc;font-size: 12px;">0</td>
                                                      <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php echo $modelSMS->amount; ?> </td>
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
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo ucwords($modelEmail->invoicefor).' '.SERVICE; ?>
                                                    </td>
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelEmail->hsn_sac; ?>
                                                    </td>
                                                    
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelEmail->quantity; ?>
                                                    </td>
                                                    
                                                    <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php 
										//$rate = $invoice->amount/$invoice->quantity;
										echo $modelEmail->rate;
										$total_amt=$modelEmail->amount; 
									?>
                                                    </td>
                                                    <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $modelEmail->amount; ?>
                                                    </td>
                                                </tr>
                                               <?php											
								if($modelEmail->servicetax > 0)
									$sub_total_with_servicetax+=round($modelEmail->amount);
								
							
                                                if(!empty($modelEmail->discount)){?>
                                                        
                                                   
                                                            <td style="text-align:right;border: 1px solid #ccc;font-size: 12px;"><?php echo round($modelEmail->discount);?> </td>
                                                            <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php 
                                                            $total_dis = round($modelEmail->amount-$modelEmail->discount); 
                                                            $total_amt= round($total_dis+$modelEmail->charges); 
                                                            echo round($total_amt);
                                                             ?> </td>
                                                    </tr>
                                                <?php }else{ ?>
                                                    <td style="text-align:right;border: 1px solid #ccc;font-size: 12px;">0</td>
                                                            <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php echo $modelEmail->amount;?> </td>
                                                    
                                               <?php }
                                                $final_total +=$total_amt;
                                                }
                                                
                                                            ?>		
                                                              
                                                    
                                                    
                                                    
                                                <tr style="height: 35px;font-size:12px;width:100%;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px; ">
                                                        &nbsp;&nbsp; <b>Total</b>
                                                    </td>

                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo round($final_total);?> 
                                                    </td>


                                                </tr>
                                                                              
                                                
                                                <?php
                                                       $total_tax=round($final_total*(9)/100);
                                                 
                                               ?>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>CGST(9%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $total_tax;?>
                                                    </td>
                                                </tr>
                                                 
                                               <?php
                                                       $total_tax1=round($final_total*(9)/100);
                                                       $grand_total = $total_tax1+$total_tax+$final_total;
                                               ?>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>SGST(9%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $total_tax1;?>
                                                    </td>
                                                </tr>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>IGST(18%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; 0
                                                    </td>
                                                </tr>
                                               
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid blue; border-collapse: collapse;text-align:left; font-size: 12px;">
                                                        &nbsp;&nbsp; <b>Amount due in INR </b>
                                                    </td>

                                                    <td style="border: 1px solid blue; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <b><?php echo round($grand_total);?></b>
                                                    </td>
                                                </tr>
                                                <!-- end 2 table -->
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
                                                        <p style=" margin: 0;font-size: 12px;">PAN No&nbsp;:&nbsp;<?php echo ucwords($owndetails->pan_number);?> &nbsp;&nbsp;&nbsp;Service Tax No&nbsp;:&nbsp; AAQFB5775RSD001 </p>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>0  
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
                                                        <p style=" border-bottom: 1px solid #000; margin: 0; height: 25px;width: 120px;display: inline-block;font-size: 13px; font-weight: 600;">Bank Details:</p>
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
                                                <!-- title -->

                                                <tr>
                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>Account Name&nbsp;:&nbsp;Business Apps</li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            &nbsp;
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 400px;">
                                                        <ul>
                                                            
                                                            <li>Bank Name&nbsp;:&nbsp;<?php echo ucwords($owndetails->bank_name);?></li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>Account No&nbsp;:&nbsp;<?php echo ucwords($owndetails->account_no);?></li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width: 400px;">
                                                        <ul>
                                                            
                                                             <li>Branch Name&nbsp;:&nbsp;<?php echo ucwords($owndetails->branch_name);?></li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>Account Type&nbsp;:&nbsp;<?php echo ucwords($owndetails->accountlist->account_type);?></li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>MICR Code&nbsp;:&nbsp;<?php echo ucwords($owndetails->micr_code);?></li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>IFSC Code&nbsp;:&nbsp;<?php echo ucwords($owndetails->ifsc_code);?></li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <!-- end of title -->
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
                                                        <p style=" border-bottom: 1px solid #000; margin: 0; height: 25px;width: 192px;display: inline-block;font-size: 13px; font-weight: 600;">Terms & Conditions:</p>
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
                                                        <ul>
                                                            <?php echo ucwords($owndetails->term_conditions);?>
<!--                                                            <li> Training's & Technical backup would be provided online, telephonic or personally as per needed by the sole direction of Business Apps.</li>
                                                            <li> Data security will be applicable as per cloud services policy.</li>
                                                            <li> All above amounts are inclusive of Taxes.</li>
                                                            <li> Purchase Order and all Payments should be made in the name of "Business Apps".</li>
                                                            <li> Terms & conditions * of the services are applicable as mentioned on www.businessapps.co.in.</li>-->
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
                                    <td width="800">
                                        <table width="800" align="left  "cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>												
                                                <tr>
                                                     <td style="width: 800px;">
                                                        <ul>
                                                            <li> Training's & Technical backup would be provided online, telephonic or personally as per needed by the sole direction of Business Apps.</li>
                                                            <li> Data security will be applicable as per cloud services policy.</li>
                                                            <li> All above amounts are inclusive of Taxes.</li>
                                                            <li> Purchase Order and all Payments should be made in the name of "Business Apps".</li>
                                                            <li> Terms & conditions * of the services are applicable as mentioned on www.businessapps.co.in.</li>
                                                        </ul>
                                                    </td>												
                                                </tr>										
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="800">
                                        <table width="800" align="right" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>												
                                                <tr>
                                                    <td style="width: 800px;">
                                                        <span style="width: 130px;text-align: center;">For Business Apps</span>
                                                        <img src="<?php echo $uploads_dir;?>stamp.png" style="width:100px;height:auto;margin-bottom: 12px;">
                                                         <span style="width: 130px;padding-top: 5px;margin-top: 5px;text-align: center;">Authorised Signatory</span>
                                                    </td>												
                                                </tr>										
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