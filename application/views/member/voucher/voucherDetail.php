<?php
	echo "<style>#errmsg {
				  color: red;
				}
				#errmsgstart {
				  color: red;
				}
				#errmsgend {
				  color: red;
				}
		 </style>
		 <form id=\"formReleaseVcr\">";
		 
		 
	echo "<table class='table table-striped table-bordered' width='80%' id='headertrx'> 
			<thead><tr><th colspan=2>HEADER INFO</th></tr>
			   <tr>
				 <td>Stockist</td> 
				 <td>$stockist</td>
				 
			   </tr>
			   <tr>
			     <td>Trx No.</td>
				 <td>$trcd<input type='hidden' id='trcd' name='trcd' value='$trcd'></td>
			   </tr>
			   <tr>
			     <td>Trx Date</td>
				 <td>$trdt</td>
				 
			   </tr> 
			   <tr>
			     <td>Receipt No.</td>
			     <td>$receiptno</td>
			      
			   </tr>
	           <tr>
				 <td>Receipt Date</td>
				 <td>$receiptdt</td>
			    
		       </tr>
			  <tr>
				<td>Product</td>
				<td>
					<select clas='span6' id='prdcdSK' name='prdcd' onchange=\"wh.changeSKProduct()\">
					<option value=''>--Select here--</option>
					";
					
					$i = 1;
					$tot_dpr = 0;
					$tot_bvr = 0;
					$tot_qty = 0;
					foreach($result as $data) {
						
						//A.invoiceno, a.prdcd, b.prdnm, b.kit, a.qtyord, a.dp, a.bv
						$prdcd = $data->prdcd;
						$prdnm = $data->prdnm;
						$kit = $data->kit;
						$qtyord = $data->qtyord;
						$qtyord2 = number_format($qtyord,0,"","");
						$qtyReleased = number_format($data->jml_active,0,"","");
						$qtyRemain = number_format($data->sisa_qty,0,"","");
						$dp = $data->dp;
						$bv = $data->bv;
						$updatenm = null;
						$updatedt = null;
						$startno = null;
						$endno = null;
	
	                    echo "<option value=\"$prdcd**$kit**$qtyord2**$qtyRemain\">$prdcd - $prdnm</option>" ;    
	                }
//$totRec = count($voucherno);
				echo "</select>&nbsp;
				Qty Prd&nbsp;
				<input readonly=readonly type=text id=qtyReleased style=\"width:30px;\" name=qtyReleased value=\"\" />
				Qty Released&nbsp;
				<input readonly=readonly type=text id=qtyReleased2 style=\"width:30px;\" name=qtyReleased2 value=\"\" />
				Qty Remain&nbsp;
				<input type=text style=\"width:30px;\" id=qtyRemain name=qtyRemain value=\"\" onblur=\"wh.checkValidQtyVch()\" />
				<input type=hidden id=productcode name=productcode value='' />
				<input type=hidden id=trxno name=trxno value=\"$trcd\" />
				<input type=hidden id=stockist name=stockist value=\"$stockist\" />
				<input type=hidden id=receiptno name=receiptno value=\"$receiptno\" />
				<input type=hidden id=trdt name=trdt value=\"$trdt\" />
				<input type=hidden id=receiptdt name=receiptdt value=\"$receiptdt\" />
				</td>
			
			</tr>
			
		 </thead>
		 <tbody id=rec>
		   <tr> 
		    <td>
		       Voucher Start#&nbsp;
		       
		    </td>
		    <td>   
		       <input type='text' id='vch_start' name='vch_start' value='' onchange=\"wh.checkVchStart()\">
		       &nbsp;End#&nbsp;
		       <input type='text' id='vch_end' name='vch_end' value='' readonly='readonly'>
		       &nbsp;
		       <input type='button' value='Save' id='btnUpdVch' class='btn btn-primary' onclick=\"wh.updateReleaseVch()\" />
		    </td>
		   </tr>   
		     
		 </tbody>
		 </table>";
	

//var_dump($voucherno);
//echo "count = ".count($voucherno);
//echo "<input type='hidden' id='totvoucher' name='totvoucher' value='$totRec'>";

  echo "<div id=\"listReleasedVch\"></div>";

?>
<p></p>
	<div>
		 <input value="<< Back" type="button" class="btn btn-small btn-warning" onclick="All.back_to_form(' .nextForm1',' .mainForm')"/>
		 <!--<input type="button" value="Save Changes" class="btn btn-small btn-primary" onclick="be_member.updateDataMember()" />-->
    </div>
	<p></p>
<?php
echo "</form>";

	
?>

