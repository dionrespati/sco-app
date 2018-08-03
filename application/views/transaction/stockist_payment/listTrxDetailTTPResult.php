<?php
	if(isset($error)) {
		echo $error;
	} else {
	
?>

<table width="95%" align="center" class="table table-striped table-bordered bootstrap-datatable">
  <tbody>	
  	<?php
  	 $res = $result;
  	?>
  	<tr>
  		<td width="15%">MSR/SSR No</td>
  		<td><?php echo $res[0]->batchno; ?></td>
  	</tr>
  	<tr>
  		<td>ID Stockist</td>
  		<td><?php echo $res[0]->sc_dfno; ?></td>
  	</tr>	
  	<tr>
  		<td>Co. Stockist</td>
  		<td><?php echo $res[0]->sc_dfno; ?></td>
  	</tr>
  	<tr>
  		<td>Main Stockist</td>
  		<td><?php echo $res[0]->loccd; ?></td>
  	</tr>
  </tbody>
 </table>
 <table width="95%" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
 	<tr>
 		<th colspan="6">Daftar TTP MSR/SSR <?php echo $res[0]->batchno; ?></th>
 	</tr> 	
	<tr> 
		<th width="5%">No</th>
		<th width="15%">Order No.</th>
		<th width="15%">ID Member</th>
		<th>Nama Member</th>
		<th width="15%">Total DP</th>
		<th width="15%">Total BV</th>
	</tr>
  </thead>
  <tbody>
  	<?php
  	  $i = 1;
  	  foreach($res as $dta) {
	  	  echo "<tr>";
		  echo "<td align=right>$i</td>";
		  echo "<td align=center>$dta->trcd</td>";
		  echo "<td align=center>$dta->dfno</td>";
		  echo "<td align=left>$dta->fullnm</td>";
		  echo "<td align=right>".number_format($dta->ndp,0,".",".")."</td>";
		  echo "<td align=right>".number_format($dta->nbv,0,".",".")."</td>";
		  echo "</tr>";
		  $i++;
	  }
  	?>
  	<tr>
  		<td colspan="2"><?php backToMainForm(); ?></td>
  		<td colspan="4">&nbsp;</td>
  	</tr>
  </tbody>
</table>  
<?php
}
?>