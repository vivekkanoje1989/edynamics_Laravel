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
                    <!-- title -->
                    
                    <tr>
                      <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Customer Invoice</h4></td>
                    </tr>
                    <tr>
                      <td width="100%" height="10">&nbsp;</td>
                    </tr>
                    <!-- end of title -->
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
                      <td align="left" width="150"><img src="<?php echo $uploads_dir;?>logo.png" style="height: 65px;width: auto;"/></td>
                      <td align="center" width="500"><table width="500" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr>
                              <td  colspan="2" align="center"   style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Business Apps</h4></td>
                            </tr>
                               <tr>
              <td width="100%" height="10"></td>
            </tr>
            <?php if(!empty($modelEmail)){
    $billmonth = $modelEmail->from_date;
}else if(!empty($modelSMS)){
    $billmonth = $modelSMS->from_date;
} ?>
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
                                    <td  style="width:250px;text-align: left;"> <strong>Invoice Date&nbsp;:&nbsp; </strong><?php echo date('d-m-Y',strtotime($invoice_date)); ?></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                                  <td width="250" ><table width="250" cellpadding="5" cellspacing="0" border="0">
                                  <tbody>
                                    <tr>
                                    <td  style="width:250px;text-align: left;"><strong>Bill Month&nbsp;:&nbsp; </strong> <?php echo date('M Y',strtotime($billmonth)); ?></td>
                                    </tr>
                                       <tr>
                                    <td  style="width:250px;text-align: left;"><strong>Due Date&nbsp;:&nbsp;</strong><?php echo date('d-m-Y', strtotime($invoice_date. ' + 5 days')); ?></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td align="right" width="150"><img src="<?php echo $uploads_dir;?>lms.png"  style="width: 120px;height: auto;"/><br><img src="<?php echo $uploads_dir;?>Nextedge.png"  style="width: 120px;height: auto;"/></td>
                    </tr>
                    
                    <!-- end of title -->
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
                    <!-- title -->
                     <tr>
                      <td style="width: 325px;text-align: right;color: #cfcccc;padding-top: 5px;" valign="top">
                 _______________________________________
                                          </td>                                        <td valign="top" style="width: 150px; text-align:center; padding:5px; border:1px solid #ccc; border-radius:5px;">Value Added Services<br/><span style="font-size:11px;"><b>Tax Invoice</b></span>
                                          </td>  
                      <td style="width: 325px;text-align: left;color: #cfcccc;padding-top: 5px;" valign="top">_____________________________________</td>
                    </tr>
            </tbody></table></td></tr>
            
            <tr>
              <td width="800">
              <table width="800" align="center" cellspacing="0" cellpadding="0" border="0">
                  <tbody>
                    <!-- title -->
                  
                    <tr>
                      <td style="width: 200px;"><b>To&nbsp;,&nbsp;</b>
                                          </td>
                                         <td style="width: 200px;">&nbsp;&nbsp;
                                          </td>  
                      <td style="width: 200px;text-align:left;"><b>From&nbsp;,&nbsp;</b></td>
                    </tr>
                    <tr>
                      <td style="width:200px;" valign="top"><?php echo ucwords( $client->marketing_name );?><br><?php echo ucwords($client->legal_name);?><br>
                                                                    <?php echo ucwords($client->office_addres);?><br>
                                                                    <?php echo ucwords($client->cityList->name);
                                                                           echo ' '.ucwords($client->pin_code).' ,';?><br>
                                                                    <?php echo ucwords($client->stateList->name);?></td>
                          <td style="width: 200px;">&nbsp;&nbsp;
                                          </td>  
                                          
                      <td style="width: 200px;text-align: left;" valign="top"><?php echo ucwords($owndetails->marketing_name );?><br>
                                                                                <?php echo ucwords($owndetails->legal_name);?><br>
                                                                    <?php echo ucwords($owndetails->office_addres);?><br>
                                                                    <?php echo ucwords($owndetails->cityList->name);
                                                                       echo ' '.ucwords($owndetails->pin_code).' ,';?><br>
                                                                    <?php echo ucwords($owndetails->stateList->name);?>
                        </td>
                        
                    </tr>
                    <tr>                <td style="width: 200px;"><b>GSTIN&nbsp;:&nbsp;</b>
                                          </td>  
                                          <td style="width: 200px;">&nbsp;&nbsp;
                                          </td>
                                              <td style="width: 200px;"><b>GSTIN&nbsp;:&nbsp;</b>
                                          </td>  </tr>
                                            <tr>   <td style="width: 200px;"><b>State Code&nbsp;:&nbsp;</b>
                                          </td>  
                                               <td style="width: 200px;">&nbsp;&nbsp;
                                          </td>
                                              <td style="width: 200px;"><b>PAN No.&nbsp;:&nbsp;</b>
                                          </td>  </tr>
                    
                    <!-- end of title -->
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
              <td width="800"><table width="800" align="center" cellspacing="0" cellpadding="0" border="0" >
                  <tbody>
                    <!-- title -->
                    
                    <tr>
                      <td  style="font-family: Helvetica,arial,sans-serif;font-size: 19px;color:rgb(0, 0, 0);text-align: center;line-height: 15px;font-weight: 800;"><h4 style="margin: 0;">Your Account Summary</h4></td>
                    </tr>
                    <tr>
                      <td width="100%" height="10">&nbsp;</td>
                    </tr>
                    <!-- end of title -->
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
                    <!-- title -->
                    
                    <tr>
                      <td  style="width:145px; text-align:center; " width="145px">
                    <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Previous Balance</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;5,000</td>
                    </tr>
                    </table>
                      
                      </td> 
                         <td  style="width:15;text-align:center; border:none;"> &nbsp;-&nbsp;</td>   
                             <td  style="width:145px; text-align:center; " width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Last Payment</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;5,000</td>
                    </tr>
                    </table></td> 
                          <td  style="width:15;text-align:center"  width="25">&nbsp;=&nbsp;</td>    
                         <td  style="width:145px; text-align:center; " width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Last Payment</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;5,000</td>
                    </tr>
                    </table></td>
                        <td  style="width:15;text-align:center" width="25">&nbsp;+&nbsp;</td>    
                       <td  style="width:145px; text-align:center; " width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Last Payment</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;5,000</td>
                    </tr>
                    </table></td>
                       <td  style="width:15;text-align:center" width="25">&nbsp;=&nbsp;</td>
                   <td  style="width:145px; text-align:center;" width="145px">
                          <table width="145px" align="center" cellspacing="0" bordercolor="#999999" cellpadding="5" border="1" >
                    <tr>
                    <td style="border-bottom:1px solid #ccc; text-align:center">&nbsp;Last Payment</td>
                    </tr><tr>
                    <td style="text-align:center">&nbsp;5,000</td>
                    </tr>
                    </table></td>
                    </tr>
                    <tr>
                      <td colspan="8" width="100%" height="10">&nbsp;</td>
                    </tr>
                    <!-- end of title -->
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </td>
    </tr>
  </tbody>
</table>
</body>
</html>