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
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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

                        <table width="800"  align="" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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

                                                    <td style="width: 400px;text-align: right;">
                                                        <b>Bill Month&nbsp;:&nbsp;</b><?php echo date('M Y',strtotime($invoice_date)); ?>
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
                        
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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
                                                        <b>From&nbsp;:&nbsp;Business Apps</b>
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
                                                                    echo ','.ucwords($client->stateList->name);?>
                                                        </p>
                                                    </td>
                                                    <td style="width:60px;">
                                                        &nbsp;
                                                    </td>
                                                    <td style="width: 370px;">
                                                        <p>
                                                            No 1, Shriram Samruddhi, Richmond Park,<br>
                                                            Opp. Orchid School, Near Balewadi Phata,<br>
                                                            Baner Road, Pune 411045.<br>
                                                            +91 8657 33 77 33

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

                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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


                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
                            <tbody>

                                <tr>
                                    <td width="800">
                                        <table width="800" style="font-size:14px;" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <!-- start 1 table -->

                                                <tr style="background: #ececec; height: 35px;"  width="800">
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:70px;">
                                                        <b>Sr.No.</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:240px;">
                                                        <b>Items</b>
                                                    </th>
                                                     <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:240px;">
                                                        <b>HSN/SAC</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Quantity</b>
                                                    </th>
                                                    
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:75px;">
                                                        <b>Rate</b>
                                                    </th>
                                                    <th style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;width:100px;">
                                                        <b>Sub Total</b>
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
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;text-align:center;">
                                                        &nbsp;&nbsp; <?php echo $cnt++;?>
                                                    </td>
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
                                                </tr>
                                               <?php											
								if($modelSMS->servicetax > 0)
									$sub_total_with_servicetax+=round($modelSMS->amount);
								
							
                                                if(!empty($modelSMS->discount)){?>
                                                        
                                                    <tr style="font-size:12px;width:100%;"  width="800">
                                                           
                                                            <td colspan="5" style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;">Discount<?php  echo '( '.$modelSMS->discount_for. ' )'; ?></td>
                                                            <td style="text-align:right;border: 1px solid #ccc;font-size: 12px;"><?php echo round($modelSMS->discount);?> </td>
                                                    </tr>
                                                 <?php   if(!empty($modelSMS->charges)){?>
                                                    <tr style="font-size:12px;width:100%;"  width="800">
                                                          <td colspan="5" style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;">Charges <?php echo '( '.$modelSMS->charges_for. ' )';?></td>
                                                            <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php echo round($modelSMS->charges); ?> </td>
                                                    </tr>
                                                     <?php } ?>
                                                    <tr style="font-size:12px;width:100%;"  width="800">
                                                           
                                                            <td colspan="5" style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;">Sub Total</td>
                                                            <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php 
                                                            $total_dis = round($modelSMS->amount-$modelSMS->discount); 
                                                            $total_amt= round($total_dis+$modelSMS->charges); 
                                                            echo round($total_amt);
                                                             ?> </td>
                                                    </tr>
                                                <?php }
                                                $final_total +=$total_amt;
                                                    $total_tax+= $modelSMS->servicetax;
                                                    $grand_total = $total_tax+$final_total;
                                                }
                                                
                                                ?>
                                                
                                                <?php if(!empty($modelEmail) && $modelEmail->amount > 0)    
                                                {
                                                  ?>
                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td style="border: 1px solid #ccc; border-collapse: collapse; font-size: 12px;text-align:center;">
                                                        &nbsp;&nbsp; <?php echo $cnt++;?>
                                                    </td>
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
                                                        
                                                    <tr style="font-size:12px;width:100%;"  width="800">
                                                           
                                                            <td colspan="5" style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;">Discount<?php  echo '( '.$modelEmail->discount_for. ' )'; ?></td>
                                                            <td style="text-align:right;border: 1px solid #ccc;font-size: 12px;"><?php echo round($modelEmail->discount);?> </td>
                                                    </tr>
                                                 <?php   if(!empty($modelEmail->charges)){?>
                                                    <tr style="font-size:12px;width:100%;"  width="800">
                                                          <td colspan="5" style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;">Charges <?php echo '( '.$modelEmail->charges_for. ' )';?></td>
                                                            <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php echo round($modelEmail->charges); ?> </td>
                                                    </tr>
                                                     <?php } ?>
                                                    <tr style="font-size:12px;width:100%;"  width="800">
                                                           
                                                            <td colspan="5" style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;">Sub Total</td>
                                                            <td style="text-align:right;border: 1px solid #ccc; border-collapse: collapse;font-size: 12px;"><?php 
                                                            $total_dis = round($modelEmail->amount-$modelEmail->discount); 
                                                            $total_amt= round($total_dis+$modelEmail->charges); 
                                                            echo round($total_amt);
                                                             ?> </td>
                                                    </tr>
                                                <?php }
                                                $final_total +=$total_amt;
                                                }
                                                
                                                            ?>		
                                                              
                                                     <?php
                                                    //$total_tax+= $modelEmail->servicetax;
                                                    //$grand_total = $total_tax+$final_total;
                                                    
                                                     ?>
                                                    
                                                    
                                                <tr style="height: 35px;font-size:12px;width:100%;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="2" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px; ">
                                                        &nbsp;&nbsp; <b>Total</b>
                                                    </td>

                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo round($final_total);?> 
                                                    </td>


                                                </tr>
                                                
<!--                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="2" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>Service Tax (18%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #ccc; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $total_tax;//round((($sub_total_with_servicetax*$servicetax_info->service_tax_total)/100));

                                                    ?>
                                                    </td>


                                                </tr>-->
                                                
                                                
                                                                                              
                                                
                                                <?php
                                                       $total_tax=round($final_total*(9)/100);
                                                 
                                               ?>
                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border: 1px solid #fff; border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="2" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
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

                                                    <td colspan="2" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
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

                                                    <td colspan="2" style="border: 1px solid #ccc; border-collapse: collapse;text-align:left;font-size: 12px;">
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

                                                    <td colspan="2" style="border: 1px solid blue; border-collapse: collapse;text-align:left; font-size: 12px;">
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

                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
                            <tbody>
                                <tr>
                                    <td width="100%" height="10"></td>
                                </tr>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>												
                                                <tr>
                                                    <td style="width: 800px;">
                                                        <img src="<?php echo $uploads_dir;?>stamp.png" style="width:100px;height:auto;margin-bottom: 10px;">
                                                         <p style="width: 130px;padding-top: 5px;margin-top: 5px;text-align: center;border-top: 1px solid #000">For Business Apps</p>
                                                    </td>												
                                                </tr>										
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
                            <tbody>
                               
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>

                                                <tr>
                                                    <td style="width: 800px;">
                                                        <p style=" margin: 0;font-size: 12px;">PAN No&nbsp;:&nbsp; AAQFB5775R &nbsp;&nbsp;&nbsp;Service Tax No&nbsp;:&nbsp; AAQFB5775RSD001 </p>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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
                                                            
                                                            <li>Bank Name&nbsp;:&nbsp;State Bank Of India</li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>Account No&nbsp;:&nbsp;35887111973</li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width: 400px;">
                                                        <ul>
                                                            
                                                             <li>Branch Name&nbsp;:&nbsp;PBB Balewadi, Pune.</li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>Account Type&nbsp;:&nbsp;Current Account</li>
                                                            
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>MICR Code&nbsp;:&nbsp;411002108</li>
                                                        </ul>	
                                                    </td>

                                                    <td style="width: 400px;">
                                                        <ul>
                                                            <li>IFSC Code&nbsp;:&nbsp;SBIN0016845</li>
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

                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
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
                        <table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 10px;">
                            <tbody>
                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
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
                                </tr>
                            </tbody>
                        </table>

                        <table width='800'  align='center' cellspacing='0' cellpadding='0' border='0'>
                                <tbody>
                                    <tr style='width:800px;background:url(<?php echo $uploads_dir?>new-footer-old1.png);background-size: cover; '>
                                        <td style='height:160px;'>

                                                &nbsp;

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='background: #d1d2d4;'>
                                            <p style='padding-bottom: 5px;background: #d1d2d4;text-align: center;font-size: 10px;margin: 0;width:100%;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No 1, Shriram Samruddhi, Richmond Park, Opp. Orchid School, Near Balewadi Phata, Baner Road, Pune 411045.
                                             PH : +91 8657 33 77 33 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></p>
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