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


                                                <tr>
                                                    <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Edynamics Business Services LLP.</h4></td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" height="10">&nbsp;</td>
                                                </tr>

                                            </tbody>
                                        </table></td>
                                </tr>
                            </tbody>
                        </table>

                        <table width="800"  align="center"  cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
                            <tbody>
                                <tr>
                                    <td width="800"><table width="800"  cellspacing="0" cellpadding="0" border="0" >
                                            <tbody>
                                                <tr>
                                                    <td align="left" width="150">
                                                        <img src="<?php echo $uploads_dir; ?>logo.jpg" style="height: 65px;width: auto;"/>
                                                    </td>
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
                                                                                    <td style="width:250px;text-align: left;"><strong>Invoice No&nbsp;:&nbsp; </strong> <?php echo $invoiceno; ?> </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  style="width:250px;text-align: left;"> <strong>Invoice Date&nbsp;:&nbsp; </strong><?php echo date('d/m/Y', strtotime($invoice_date)); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                    </td>


                                                                    <td width="250" >
                                                                        <table width="250" cellpadding="5" cellspacing="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td  style="width:250px;text-align: right;"><strong>Bill Month&nbsp;:&nbsp; </strong> <?php echo $billmonth; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  style="width:250px;text-align: right;"><strong>Due Date&nbsp;:&nbsp;</strong><?php echo date('d/m/Y', strtotime($invoice_date . ' + 9 days')); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table></td>
                                                                </tr>
                                                            </tbody>
                                                        </table></td>
                                                    <td align="right" width="150">
                                                        <img src="<?php echo $uploads_dir; ?>bms.png"  style="width: 120px;height: 50px;"/>
                                                        <br>
                                                        <img src="<?php echo $uploads_dir; ?>Nextedge.png"  style="width: 120px;height: auto;"/>
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

                                                <tr>
                                                    <td style="width: 325px;text-align: right;color: #000;padding-top: 5px;" valign="top">
                                                        ____________________________________________________________
                                                    </td>                                        <td valign="top" style="width: 150px; text-align:center; padding:5px; border:1px solid #000; border-radius:15px!important;">Cloud Telephony<br/><span style="font-size:11px;"><b>Tax Invoice</b></span>
                                                    </td>  
                                                    <td style="width: 325px;text-align: left;color: #000;padding-top: 5px;" valign="top">__________________________________________________________</td>
                                                </tr>
                                            </tbody></table></td></tr>

                                <tr>
                                    <td width="800">
                                        <table width="800" align="center" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>


                                                <tr>
                                                    <td style="width: 200px;"><b>To&nbsp;,&nbsp;</b>
                                                    </td>
                                                    <td style="width: 400px;">&nbsp;&nbsp;
                                                    </td>  
                                                    <td style="width: 200px;text-align:left;"><b>From&nbsp;,&nbsp;</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:200px;" valign="top"><?php echo ucwords($client->marketing_name); ?><br>
                                                        <?php echo ucwords($client->office_address); ?><br>
                                                        <?php
                                                        echo ucwords($client->city_name);
                                                        echo ' ' . ucwords($client->pin_code) . ' ,';
                                                        ?><br>
                                                        <?php echo ucwords($client->state_name); ?></td>
                                                    <td style="width: 400px;">&nbsp;&nbsp;
                                                    </td>  

                                                    <td style="width: 200px;text-align: left;" valign="top"><?php echo ucwords($owndetails->marketing_name); ?><br>

                                                        <?php echo ucwords($owndetails->office_address); ?><br>
                                                        <?php
                                                        echo ucwords($owndetails->cityList->name);
                                                        echo ' ' . ucwords($owndetails->pin_code) . ' ,';
                                                        ?><br>
<?php echo ucwords($owndetails->stateList->name); ?>
                                                    </td>

                                                </tr>
                                                <tr>                
                                                    <td style="width: 200px;"><b>GSTIN&nbsp;:&nbsp;<?php echo ucwords($client->gst_number); ?></b>
                                                    </td>  
                                                    <td style="width: 200px;">&nbsp;&nbsp;
                                                    </td>
                                                    <td style="width: 200px;"><b>GSTIN&nbsp;:&nbsp;<?php echo ucwords($owndetails->gst_number); ?></b>
                                                    </td>  </tr>
                                                <tr>   <td style="width: 200px;"><b>State Code&nbsp;:&nbsp;<?php echo ucwords($client->state_code); ?></b>
                                                    </td>  
                                                    <td style="width: 200px;">&nbsp;&nbsp;
                                                    </td>
                                                    <td style="width: 200px;"><b>PAN No.&nbsp;:&nbsp;<?php echo ucwords($owndetails->pan_number); ?></b>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td style="width: 200px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="width: 200px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td style="width: 200px;"><b> HSN/SAC &nbsp;:&nbsp;<?php echo $HSN; ?> </b></td>
                                                </tr>


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


                                                <tr>
                                                    <td  style="font-family: Helvetica,arial,sans-serif;font-size: 10px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Your Account Summary</h4></td>
                                                </tr>
                                                <tr>
                                                    <td width="100%" height="10">&nbsp;</td>
                                                </tr>

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


                                                <tr>
                                                    <td  style="width:145px; text-align:center; " width="145px">
                                                        <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                                                            <tr>
                                                                <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Previous Balance</td>
                                                            </tr><tr>
                                                                <td style="text-align:center">&nbsp;&#8377; 0</td>
                                                            </tr>
                                                        </table>

                                                    </td> 
                                                    <td  style="width:15;text-align:center; border:none;"> &nbsp;-&nbsp;</td>   
                                                    <td  style="width:145px; text-align:center; " width="145px">
                                                        <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                                                            <tr>
                                                                <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Last Payment</td>
                                                            </tr><tr>
                                                                <td style="text-align:center">&nbsp;&#8377; 0</td>
                                                            </tr>
                                                        </table></td> 
                                                    <td  style="width:15;text-align:center"  width="25">&nbsp;=&nbsp;</td>    
                                                    <td  style="width:145px; text-align:center; " width="145px">
                                                        <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                                                            <tr>
                                                                <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Balance</td>
                                                            </tr><tr>
                                                                <td style="text-align:center">&nbsp;&#8377; 0</td>
                                                            </tr>
                                                        </table></td>
                                                    <td  style="width:15;text-align:center" width="25">&nbsp;+&nbsp;</td>    
                                                    <td  style="width:145px; text-align:center; " width="145px">
                                                        <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                                                            <tr>
                                                                <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;This Month's Bill</td>
                                                            </tr><tr>
                                                                <td style="text-align:center">&nbsp;&#8377; <?php echo $final_invoice_ammount; ?></td>
                                                            </tr>
                                                        </table></td>
                                                    <td  style="width:15;text-align:center" width="25">&nbsp;=&nbsp;</td>
                                                    <td  style="width:145px; text-align:center;" width="145px">
                                                        <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                                                            <tr>
                                                                <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Total Bill Amount</td>
                                                            </tr><tr>
                                                                <td style="text-align:center">&nbsp;&#8377; <?php echo $final_invoice_ammount; ?></td>
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


                                                <tr style="background: #ececec; height: 35px;"  width="800">

                                                    <th colspan="2" style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;width:425px;">
                                                        <b>Description</b>
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

                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td rowspan="4" style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp;Vanity Number Rental
                                                    </td>
                                                <tr>
                                                    <td style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; Active
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $activeNumbers; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $rentamount; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $Subtotalactive; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; 0
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $Subtotalactive; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; Freezed
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $freezedNumbers; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo 0; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $Subtotalfreezed; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; 0
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $Subtotalfreezed; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp; Zero Rental
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $zerorentalNumbers; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo 0; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $Subtotalzerorental; ?>
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; 0
                                                    </td>
                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $Subtotalzerorental; ?>
                                                    </td>
                                                </tr>


                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td colspan="2" style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp;Pri Lines Channel Rental
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $noofPrilines; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $priPrice; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $SubtotalPrilines; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php if (!empty($pridiscount)) {
    echo $pridiscount;
} else {
    echo '0';
} ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php if (!empty($pritotal)) {
    echo $pritotal;
} else {
    echo $SubtotalPrilines;
}; ?>
                                                    </td>

                                                </tr>

                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td colspan="2" style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp;Incoming Calls
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $incommingPulse; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $incoming_pulse_rate; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $SubtotalincommingPulse; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $SubtotalincommingPulse; ?>
                                                    </td>

                                                </tr>

                                                <tr style="height: 35px;width:100%;"  width="800">
                                                    <td rowspan="3" style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp;Outbound Calls
                                                    </td>
                                                <tr>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp;Local / STD
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $outgoingPulse; ?>
                                                    </td>

                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $local_outbound_pulse_rate; ?>
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $SubtotaloutgoingPulse; ?> 
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;<?php echo $SubtotaloutgoingPulse; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse; font-size: 12px;">
                                                        &nbsp;&nbsp;ISD
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0
                                                    </td>

                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0.60
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0
                                                    </td>
                                                    <td  style="border: 1px solid #000; border-collapse: collapse;text-align:right; font-size: 12px;">
                                                        &nbsp;&nbsp;0
                                                    </td>
                                                </tr>
                                                </tr>

                                                <tr style="height: 35px;font-size:12px;width:100%;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000; border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px; ">
                                                        &nbsp;&nbsp; <b>Total</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $last_amount; ?> 
                                                    </td>


                                                </tr>



                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000;border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>CGST(9%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $cgst; ?>
                                                    </td>
                                                </tr>


                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000;border-left:1px solid #000; border-collapse: collapse;text-align:left;font-size: 12px;">
                                                        &nbsp;&nbsp; <b>SGST(9%)</b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <?php echo $sgst; ?>
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
<?php
$grand_total = $sgst + $cgst + $last_amount;
?>

                                                <tr style="height: 35px;width:100%;font-size:12px;"  width="800">
                                                    <td colspan="3" style="border-collapse: collapse;">
                                                        &nbsp;
                                                    </td>

                                                    <td colspan="3" style="border: 1px solid #000;border-left:1px solid #000; border-collapse: collapse;text-align:left; font-size: 12px;">
                                                        &nbsp;&nbsp; <b>Amount due in INR </b>
                                                    </td>

                                                    <td style="border: 1px solid #000; border-collapse: collapse;text-align:right;font-size: 12px;">
                                                        &nbsp;&nbsp; <b><?php echo round($grand_total); ?></b>
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
                                                        <p style="  margin: 0; height: 25px;width: 192px;display: inline-block;font-size:12px; font-weight: 600;"><b>Amount Payable (In word)</b>: Rupees <?php echo ucwords($final_invoice_ammount_inword); ?> Only</p>
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
                                                        HSN/SAC
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

                                                <tr>
                                                    <td><?php echo $HSN; ?></td>
                                                    <td style=" text-align: center;">
                                                        <?php echo $last_amount; ?> </td>

                                                    <td style="width:75px; text-align: center;"> (9%) </td>

                                                    <td style="width:75px; text-align: center;"> <?php echo $sgst; ?></td>

                                                    <td  style="width:75px; text-align: center;"> (9%)</td>

                                                    <td style="width:75px; text-align: center;"><?php echo $cgst; ?></td>
                                                    <td style="width:75px; text-align: center;">(18%)</td>

                                                    <td style="width:75px; text-align: center;">0</td>


                                                </tr>



                                                <tr>
                                                    <td style=" text-align: right; font-weight: bold">Total</td>
                                                    <td style=" text-align: center;font-weight: bold"> <?php echo $last_amount; ?> </td>

                                                    <td style="width:75px; text-align: center;">&nbsp;</td>

                                                    <td style="width:75px; text-align: center;font-weight: bold"><?php echo $sgst; ?></td>

                                                    <td  style="width:75px; text-align: center;">&nbsp;</td>

                                                    <td style="width:75px; text-align: center;font-weight: bold"><?php echo $cgst; ?></td>
                                                    <td style="width:75px; text-align: center;">&nbsp;</td>

                                                    <td style="width:75px; text-align: center;font-weight: bold">0</td>


                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
<?php
//if(!empty($modelEmail->discount) || !empty($modelSMS->discount))
{
    ?>
                            <!-- table width="800"  align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth" style="padding: 12px;">
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
    <?php // if(!empty($modelEmail->discount)){  ?>  <li> <?php
    echo 'Discount for BMS' . $modelEmail->discount_for . ' ( Rs. ' . $modelEmail->discount . ' - ' . $modelEmail->quantity . ' G Suit ID )';

    //} 
    ?> </li>
    <?php // if(!empty($modelSMS->discount)){   ?> <li> <?php echo 'Discount for BMS' . $modelSMS->discount_for . ' ( Rs. ' . $modelSMS->discount . ' - Qty. ' . $modelSMS->quantity . ' SMS )';
}
?> </li>
                                                        </ul>	
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td style="height:10px;">&nbsp;</td></tr>
                            </tbody>
                        </table -->

<?php //}   ?>
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
                                                            <li> Training's & Technical backup would be provided online, telephonic or personally as per needed by the sole direction of Edynamics Business Services LLP..</li>
                                                            <li> Data security will be applicable as per cloud services policy.</li>
                                                            <li> All above amounts are inclusive of Taxes.</li>
                                                            <li> Purchase Order and all Payments should be made in the name of "Edynamics Business Services LLP."</li>
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
                                                            <b>Bank Name</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->bank_name); ?>,&nbsp;&nbsp;<b>Branch Name</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->branch_name); ?> <br>
                                                            <b>Account Type</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->accountlist->account_type); ?>,&nbsp;&nbsp;<b>Account No.</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->account_no); ?> <br>
                                                            <b>IFSC Code</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->ifsc_code); ?>,&nbsp;&nbsp;<b>MICR Code</b>&nbsp;:&nbsp;<?php echo ucwords($owndetails->micr_code); ?> <br>
                                                            <b>Corporate No.</b>&nbsp;:&nbsp;+91 -  9595 01 80 00
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
                                                        <img src="<?php echo $uploads_dir; ?>stamp.png" style="width:100px;height:auto;margin-bottom: 12px;">
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