<?php
//print_r($header);
?>
<form>
 <table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
        <tr style="background-color: #f4f4f4;"><th colspan="4">STOCKIST SALES REPORT</th></tr>
        <tr>
            <td width="15%">Main Stockist Code</td>
            <td width="35%">
            	<input type="hidden" id="loccd" name="loccd" value="<?php echo $header[0]->loccd; ?>"/>
            	<?php echo $header[0]->loccd; ?>
            </td>
            <td width="15%">SSR Date</td>
            <td width="35%"><?php echo $header[0]->batchdt; ?></td>
        </tr>
        <tr>
            <td>Main Stockiest Name</td>
            <td>
            	<input type="hidden" id="loccd_name" name="loccd_name" value="<?php echo $header[0]->loccd_name; ?>"/>
            	<?php echo $header[0]->loccd_name; ?>
            </td>
            <td>Bonus Period</td>
            <td><?php echo $header[0]->bnsperiod;?></td>
        </tr>
        <tr>
            <td>C/O Stockist Code</td>
            <td>
            	<input type="hidden" id="sc_co" name="sc_co" value="<?php echo $header[0]->sc_co; ?>"/>
            	<?php echo $header[0]->sc_co; ?>
            </td>
            <td>&nbsp</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>C/O Stockist Name</td>
            <td>
            	<input type="hidden" id="sc_co_name" name="sc_co_name" value="<?php echo $header[0]->sc_co_name; ?>"/>
            	<?php echo $header[0]->sc_co_name; ?>
            </td>
            <td>&nbsp</td>
            <td>&nbsp;</td>
        </tr>	
        <tr>
            <td>Stockist Code</td>
            <td>
            	<input type="hidden" id="sc_dfno" name="sc_dfno" value="<?php echo $header[0]->sc_dfno; ?>"/>
            	<?php echo $header[0]->sc_dfno; ?>
            </td>
            <td width="20%">&nbsp</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Stockist Name</td>
            <td>
            	<input type="hidden" id="sc_dfno_name" name="sc_dfno_name" value="<?php echo $header[0]->sc_dfno_name; ?>"/>
            	<?php echo $header[0]->sc_dfno_name; ?>
            </td>
            <td width="20%">&nbsp</td>
            <td>&nbsp;</td>
        </tr>
      </thead>
  </table>
  <table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
  	<thead>
  		<tr>
  			<th colspan="6">DAFTAR TRANSAKSI/TTP MEMBER</th>
  		</tr>
  		<tr>
  			<th width="6%">No</th>
            <th width="10%">No Trx</th>
            <th width="20%">ID Distributor</th>
            <th>Nama Distributor</th>
            <th width="15%">DP</th>
            <th width="10%">BV</th>
        </tr>
      </thead>
  	</thead>
  	<tbody>
  	 <?php
  	  $no = 1;
  	  foreach($listTTP as $ttp) {
  	  	echo "<tr>";
		echo "<td align=right>$no</td>";
		echo "<td align=center>$ttp->trcd</td>";
		echo "<td align=center>$ttp->dfno</td>";  
		echo "<td align=left>&nbsp;$ttp->fullnm</td>";
		echo "<td align=right>".number_format($ttp->tdp,0,",",".")."&nbsp;</td>";
		echo "<td align=right>".number_format($ttp->tbv,0,",",".")."&nbsp;</td>";    
	    echo "</tr>";
		$no++;	  
  	  }
	  
  	 ?>	
  	</tbody>	 
  </table>		  
  <table width="70%" class="table table-striped table-bordered bootstrap-datatable datatable">
  	<thead>
  		<tr>
  			<th colspan="4">REKAP PEMBELANJAAN PRODUK</th>
  		</tr>
  		<tr>
            <th width="6%">No</th>
            <th width="20%">Kode Produk</th>
            <th>Nama Produk</th>
            <th width="10%">Qty</th>
        </tr>
      </thead>
  	</thead>
  	<tbody>    
        <?php
            $i = 1;
            $selisih = 0;
            $total = 0;
            foreach($summaryProduct as $list)  {
                //$selisih = $list->qtyord - $list->qty_bc;
        ?>
	        <tr>
	            <td align="right">&nbsp;<?php echo $i; ?></td>
	            <td align="center">&nbsp;<?php echo $list -> prdcd; ?></td>
	            <td>&nbsp;<?php echo $list -> prdnm; ?></td>
	            <td align="right">&nbsp;<?php echo number_format($list->qtyord,0,",","."); ?></td>
	        </tr>
        <?php $i++;
			$total += $list -> qtyord;
			}
		?>
    </tbody>
    
  </table>
<?php backToMainForm(); ?>
</form>