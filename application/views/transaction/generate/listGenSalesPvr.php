
<?php if(empty($idstk)){
        echo "<div align=center class='alert alert-error'>Data tidak ditemukan..!!</div>";
    }else{
?>

        <form id="generateSaless" method="post" >
            <table style="width: 95%;" class="table table-striped table-bordered bootstrap-datatable datatable" align="center">
                <thead>
                	<tr>
                		<?php 
                			$bnsperiod = date('d/m/Y', strtotime($idstk[0]->bnsperiod));
                		?>
                		<th colspan="8">DAFTAR TRANSAKSI PRODUCT VOUCHER (Periode Bonus : <?php echo $bnsperiod; ?>)</th>
                	</tr>
                    <tr bgcolor="#f4f4f4">
                        <th width="5%"><input type="checkbox" name="checkall" onclick="All.checkUncheckAll(this)"/></th>
                        <th width="5%">No</th>
                        <th width="13%">No Trx</th>
            			<th>ID Member</th>
                        <th>Nama Member</th>
                        <th>Stockist</th>
                        <th width="10%">Tgl Trx</th>
                        <th width="15%">Total Harga</th>
                        <!--<th>Periode Bonus</th>-->
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                $totalDp = 0;
				$totaLBV = 0;
                foreach($idstk as $row)
                {
                    $scco = $row->sc_co;
                    //$trxdate = date('d/m/Y', strtotime($row->etdt));
                    $bnsperiod = date('d/m/Y', strtotime($row->bnsperiod));
					$tgltrx = date('d/m/Y', strtotime($row->etdt));
					$url = "sales/detail/".$row->sc_co."/".$row->sc_dfno."/".$bnsperiod;
                    echo "
                    <tr>
                        <td><div align=center>
                        <input type=checkbox id=cek[] name=cek[] value=\"".$row->trcd."\" />
                        <input type=\"hidden\" name=\"scCO[]\" value=\"".$scco."\"/>
                        </div>
                        </td>
                        <td style=\"text-align:right;\">$i</td>
                       <td style=\"text-align:center;\">".$row->trcd."</td> 
                       <td style=\"text-align:center;\">".$row->dfno."</td>
                       <td style=\"text-align:center;\">".$row->fullnm."</td> 
                       <td style=\"text-align:center;\"><a id=\"$row->sc_dfno\" onclick=\"All.ajaxShowDetailonNextForm('$url')\">".$row->sc_dfno."</a></td>
                       <td><div align=center>".$tgltrx."</div></td>
                       <td><div align=right>".number_format($row->totpay,0,"",".")."&nbsp;</div></td>
                    </tr>";
					//<td><div align=center>".$bnsperiod."</div></td>
                    $totalDp += $row->totpay;
					//$totaLBV += $row->totbv;
                }
                ?>
                    <tr>
                    	<td colspan="2">
                    		<input type="button" class="btn btn-success span20" onClick="Sales_sco.get_group_prod(); return false;" name="submit" value="Process" id="checkss"/>
                    	</td> 
                        <td colspan="5" style="text-align: right;">T O T A L</td>
                        <td style="text-align: right;"><?php echo number_format($totalDp,0,"",".");?>&nbsp;</td>
                        <!--<td colspan="1">&nbsp;</td>-->
                        
                    </tr>
                    
                </tbody>
            </table>
            <input type="hidden" name="typee" value="<?php echo $searchs;?>"/>
            <input type="hidden" name="bnsperiod" value="<?php echo $bnsperiod;?>"/>
            <input type="hidden" name="scDfno" value="<?php echo $idstkk;?>"/>
            
        </form>
    

<?php }?>
