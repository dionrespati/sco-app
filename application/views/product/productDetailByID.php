<?php
	if($result == null) {
		echo setErrorMessage();
	} else {
	$title = "width: 20%";	
?>
<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
   <thead>
   	 <tr>
		<th rowspan="2" width="5%">No</th>
		<th rowspan="2" width="12%">Kode</th>
		<th rowspan="2" width="45%">Nama Produk</th>
		<th colspan="2">Harga Distributor</th>
		
		<!--<th colspan="2">Harga Customer</th>-->
		<th rowspan="2">BV</th>
		<th rowspan="2">K-net</th>
		<th rowspan="2">Inden</th>
	 </tr>
	 <tr>
		<th width="8%">12W</th>
        <th width="8%">12E</th>
        <!--<th width="8%">12W</th>
        <th width="8%">12E</th>-->
	</tr>    
	
   </thead>
   <tbody> 
    <?php
     $no = 1;
      foreach($result as $data) {
      	echo "<tr>";
		echo "<td align=right>$no</td>";
		echo "<td align=center>$data->prdcd</td>";
		echo "<td align=left>&nbsp;$data->prdnm</td>";
		echo "<td align=right>".number_format($data->price_w, 0, "", ".")."</td>";
		echo "<td align=right>".number_format($data->price_e, 0, "", ".")."</td>";  
		
		//echo "<td align=right>".number_format($data->price_cw, 0, "", ".")."</td>";
		//echo "<td align=right>".number_format($data->price_ce, 0, "", ".")."</td>";
		echo "<td align=right>".number_format($data->bv, 0, "", ".")."</td>";  
		if($data->ecomm_status == "1") {
			$knet = "Y";
		} else {
			$knet = "N";
		}
		echo "<td align=center>$knet</td>";
		
		if($data->is_discontinue == "1") {
			$ind = "Y";
		} else {
			$ind = "N";
		}
		echo "<td align=center>$ind</td>";
		echo "</tr>"; 
		$no++; 
      }
    ?>
   </tbody> 
</table>	

<?php		
setDatatable();
	}
?>