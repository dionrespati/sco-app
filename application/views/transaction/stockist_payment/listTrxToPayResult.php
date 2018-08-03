<?php
if($result != null) {
?>


<table width="100%" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
  <thead>
  	<tr>
  		<th colspan="9">Daftar Sales Stockist Report Bonus Period <?php echo $result[0]->bnsperiod; ?></th>
  	</tr>	
	<tr>
		<th width="5%"><input type="checkbox" id="checkall"  name="checkall" onclick="paystk.checkUncheckAll(this)"></th> 
		<th>No</th>
		<th>SSR No.</th>
		<th>Stk</th>
		<th>Co Stk</th>
		<th>Main Stk</th>
		<th>Trx Date</th>
		<th>Total DP</th>
		<th>Total BV</th>
	</tr>
  </thead>
  <tbody>
  	<?php
  	  $i=1;
  	  foreach($result as $dta) {
  	  	echo "<tr>";
		  $pay = number_format($dta->ndp,0,"","");
		echo "<td align=center><input class=pilihan rel=\"$pay\" id=\"pil$i\" type=checkbox value=\"$dta->batchno\" name=\"ssr[]\" onchange=\"paystk.countSelectedPrice()\"></td>";
		echo "<td align=right>$i</td>";
		$urlx = "sales/payment/ssr/".$dta->batchno;
		echo "<td align=center><a href=\"#\" onclick=\"javascript:All.ajaxShowDetailonNextForm('$urlx')\">$dta->batchno</td>";
		echo "<td align=center>$dta->sc_dfno</td>";
		echo "<td align=center>$dta->sc_co</td>";
		echo "<td align=center>$dta->loccd</td>";
		echo "<td align=center>$dta->etdt</td>";
		
		echo "<td align=right><input type=hidden id=pay$i class=pays value=\"$pay\" />".number_format($dta->ndp,0,".",".")."&nbsp;</td>";
		echo "<td align=right>".number_format($dta->nbv,0,".",".")."&nbsp;</td>";
		echo "</tr>";  
		$i++;
  	  }
  	?>
  </tbody>	
</table>
<!--
<script type="text/javascript">
$(document).ready(function() 
{
	$(".datatable").dataTable( {
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
		"sPaginationType": "bootstrap",
		"oLanguage": {
		},
        "bDestroy": true
	});
    $(".datatable").removeAttr('style');
 });

</script>-->
<?php
} else {
	echo setErrorMessage("Transaksi tidak ditemukan..");
}
?>