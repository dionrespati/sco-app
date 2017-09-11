<?php
  $header = $result['header'];
?>
<form>
	<table width="90%" class="table table-striped table-bordered bootstrap-datatable datatable">
		<thead>
			<tr bgcolor="#f4f4f4">
				<th colspan="6">Detail Transaction</th>
			</tr>
			<tr>
				<td colspan="2">Trx No</td>
				<td colspan="4">
				 <input type="hidden" id=trcd name=trcd value="<?php echo $header[0]->trcd; ?>" />
				 <?php echo $header[0]->trcd; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Order No</td>
				<td colspan="4">
				 <input type="hidden" id=orderno name=orderno value="<?php echo $header[0]->orderno; ?>" />
				 <?php echo $header[0]->orderno; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">ID Member</td>
				<td colspan="4">
				 <input type="hidden" id=dfno name=dfno value="<?php echo $header[0]->dfno; ?>" />
				 <?php echo $header[0]->dfno; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Member Name</td>
				<td colspan="4">
				 <input type="hidden" id=fullnm name=fullnm value="<?php echo $header[0]->fullnm; ?>" />
				 <?php echo $header[0]->fullnm; ?>
				</td>
			</tr>
			<tr bgcolor="#f4f4f4">
				<th width="8%">No</th>
				<th width="15%">Product Code</th> 
				<th>Product Name</th> 
				<th width="10%">Qty</th> 
				<th width="10%">Barcode</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			foreach($result['detail'] as $dta) {
			echo "<tr id=\"$i\">
			       <td align=right>$i</td>";
				
				if($dta->jumbarcode !== null) {
					echo"<td align=center>
					       <input type=button class='btn btn-mini btn-success' id=prdcd$i name=\"prdcd[]\" value=\"$dta->prdcd\" onclick=\"javascript:Stkbarcode.getListProductBarcode($i)\" />
					     </td> 
					     <td align=left>$dta->prdnm
					       <input type=\"hidden\" id=prdnm$i value=\"$dta->prdnm\" />
					     </td>
					     <td align=right>".number_format($dta->qtyord,0,"",",")."
						   <input type=\"hidden\" id=qty$i value=\"".number_format($dta->qtyord,0,"",",")."\" />
					     </td> 
					     <td align=right>$dta->jumbarcode
						   <input type=\"hidden\" id=jum_barcode\"$i\" value=\"$dta->jumbarcode\" />
						 </td>";
				} else {
					echo "<td align=center>
							<input type=\"hidden\" id=prdcd$i name=\"prdcd[]\" value=\"$dta->prdcd\" />
							<a id=\"$i\" onclick=javascript:Stkbarcode.getListProduct(this)>$dta->prdcd</a>
						  </td> 
						  <td align=left>$dta->prdnm
						   <input type=\"hidden\" id=prdnm$i value=\"$dta->prdnm\" />
						  </td> 
						  <td align=right>".number_format($dta->qtyord,0,"",",")."
						   <input type=\"hidden\" id=qty$i value=\"".number_format($dta->qtyord,0,"",",")."\" />
					     </td>
					    
					     <td align=right>0
						   <input type=\"hidden\" id=jum_barcode\"$i\" value=\"0\" />
						 </td>";
				}

			echo "</tr>";
		   $i++;
		   }
		   ?>
		</tbody>
	</table>
    <?php backToMainForm(); ?>
</form>
