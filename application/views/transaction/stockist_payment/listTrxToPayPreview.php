 <!DOCTYPE >
 <html>
 	<head>
 		<?php echo link_js_sgo("dev"); ?>
 	</head>
 	<body>
 		
 	
	<table width="70%" align="center" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="4">Daftar SSR/MSR yang akan di bayar</th>
			</tr>
			<tr>
				<th width="10%">No</th>
				<th>SSR No</th>
				<th width="25%">Total BV</th>
				<th width="25%">Total DP</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=1;
			$tot_dp = 0;
			$tot_bv = 0;
			foreach($result as $dta) {
			    echo "<tr>";
			    $dp = number_format($dta->ndp,0,"","");
				$bv = number_format($dta->nbv,0,"","");
				echo "<td align=right>$i</td>";
				echo "<td align=center>$dta->batchno</td>";
				
				echo "<td align=right>".number_format($dta->nbv,0,".",".")."</td>";
				echo "<td align=right>".number_format($dta->ndp,0,".",".")."</td>";
				echo "</tr>";  
				$tot_dp += $dp;
				$tot_bv += $bv;
				$i++;
			}
			?>
		    <tr>
		    	<td colspan="2" align="center">T O T A L</td>
		    	<td align="right"><?php echo number_format($tot_bv,0,".","."); ?></td>
		    	<td align="right"><?php echo number_format($tot_dp,0,".","."); ?></td>
		    </tr>
		</tbody>    
		<thead>
		   	<tr>
		   		<th colspan="4">Detail Pembayaran</th>
		   	</tr>
		</thead>
		<tbody>
		   	<tr>
		    	<td colspan="3" align="right">Tipe Pembayaran</td>
		    	<td align="right"><?php echo $bankDescDetail; ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3" align="right">Total Pembayaran SSR</td>
		    	<td align="right"><?php echo number_format($tot_dp,0,".","."); ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3" align="right">Biaya Connectivity</td>
		    	<td align="right"><?php echo number_format($charge_connectivity, 0,".","."); ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3" align="right">Biaya Administrasi</td>
		    	<td align="right"><?php echo number_format($charge_admin,0,".","."); ?></td>
		    </tr>
		    <tr>
		    	<td colspan="3" align="right">Total Biaya</td>
		    	<?php $tot_cost = $tot_dp + $charge_connectivity + $charge_admin; ?>
		    	<td align="right"><?php echo number_format($tot_cost,0,".","."); ?></td>
		    </tr>
		     <tr>
		    	<td colspan="3">&nbsp;</td>
		    	<td><button class="btn btn btn-primary" onclick="submitdataXX()">Lanjut ke Pembayaran</button></td>
		    </tr>
		</tbody>
	</table>
	
	<?php $total_all = $tot_dp + $charge_connectivity; ?>
	<input type="hidden" id="total_all" name="total_all" value="<?php echo $total_all; ?>" />
    <iframe id="sgoplus-iframe" src="" scrolling="no" frameborder="0"></iframe>
    
	<script type="text/javascript">
	    
	  function submitdataXX() {
	     var total_all = $("#total_all").val();
			
	 	 var data = {
						key : "<?php echo $key; ?>",
						paymentId : "<?php echo $payID;?>",
						paymentAmount : <?php echo $total_all; ?>,
						//backUrl : "http://www.k-net.co.id/pay/sgo/finish/dev/$temp_paymentIdx;?>",
						backUrl : "<?php echo $backURL;?>",
						bankCode : "<?php echo $bankCode; ?>",
						bankProduct: "<?php echo $bankDesc; ?>"
				    },
			sgoPlusIframe = document.getElementById("sgoplus-iframe");
					
			if (sgoPlusIframe !== null) sgoPlusIframe.src = SGOSignature.getIframeURL(data);
			SGOSignature.receiveForm();
						
			
	}
	</script>       
</body>
 </html>   