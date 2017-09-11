<?php
  //$header = $result['header'];
?>
<form id="frmPrepPL">
	<table width="90%" class="table table-striped table-bordered bootstrap-datatable datatable">
		<thead>
			<tr bgcolor="#f4f4f4">
				<th colspan="6">Stock Movement to Warehouse</th>
			</tr>
			<tr>
				<td colspan="2">Send To</td>
				<td colspan="4">
				 <input type="hidden" id="sendTo" name="sendTo" value="<?php echo $form['whcode']; ?>" />
				 <?php echo $form['whcode']; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Warehouse Info</td>
				<td colspan="4">
				 <input type="hidden" id="info" name="info" value="<?php echo $form['whname']; ?>" />
				 <?php echo $form['whname']; ?>
				</td>
			</tr>
			<tr bgcolor="#f4f4f4">
				<th width="8%">No</th>
				<th width="15%">Product Code</th> 
				<th>Product Name</th> 
				<th width="10%">Qty</th> 
				
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			$jum = 0;
			foreach($result['arrayData'] as $dta) {
			echo "<tr id=\"$i\">
			       <td align=right>$i</td>";
				   echo "<td align=center>
							$dta->prdcd
							<input id=\"prdcd$i\" type=\"hidden\" value=\"$dta->prdcd\" name=\"prdcd[]\">
						  </td> 
						  <td align=left>	
						   $dta->prdnm
						   <input id=\"prdnm$i\" type=\"hidden\" value=\"$dta->prdnm\" name=\"prdnm[]\">
						  </td> 
						  <td align=right>".number_format($dta->qtyord,0,"",",")."
						   <input id=\"qtyord$i\" type=\"hidden\" value=\"$dta->qtyord\" name=\"qtyord[]\">
					     </td>
				   </tr>";
		   $i++;
		   $jum += $dta->qtyord;
		   }
			echo "<tr><td colspan=3>T O T A L</td><td align=right><input type=hidden name=totalQty value=\"$jum\" />".number_format($jum,0,"",",")."</td></tr>";
		   ?>
		</tbody>
	</table>
    <input class="btn btn-small btn-warning" type="button" onclick="All.back_to_form(' .nextForm1',' .mainForm')" value="<< Back">
    <input type="hidden" value="<?php echo $result['listDO']?>" name="listDO">
    <input class="btn btn-small btn-primary" type="button" onclick="Stkbarcode.generatePackingList()" value="Generate">
</form>
