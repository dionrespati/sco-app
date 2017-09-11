
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
							$judul = "MOBILE";
							if($searchs == "sub") {
								$judul = "SUB";
							}
                		?>
                		<th colspan="8">DAFTAR TRANSAKSI <?php echo $judul; ?> STOCKIST (Periode Bonus : <?php echo $bnsperiod; ?>)</th>
                	</tr>
                    <tr bgcolor="#f4f4f4">
                        <th width="5%"><input type="checkbox" name="checkall" onclick="All.checkUncheckAll(this)"/></th>
                        <th width="5%">No</th>
                        <th width="15%"><?php echo $tipess;?></th>
                        <th><?php echo $namess;?></th>
                        <th width="15%">Stk C/O</th>
                        <!--<th>Period Bonus</th>-->
                        <th width="10%">Total TTP</th>
                        <th width="15%">Total Harga</th>
                        <th width="10%">Total BV</th>
                        
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
					$url = "sales/detail/".$row->sc_co."/".$row->sc_dfno."/".$bnsperiod;
                    echo "
                    <tr>
                        <td><div align=center>
                        <input type=checkbox id=cek[] name=cek[] value=\"".$row->sc_dfno."\" />
                        <input type=\"hidden\" name=\"scCO[]\" value=\"".$scco."\"/>
                        </div>
                        </td>
                       <td style=\"text-align:right;\">$i</td> 
                       <td style=\"text-align:center;\"><a id=\"$row->sc_dfno\" onclick=\"All.ajaxShowDetailonNextForm('$url')\">".$row->sc_dfno."</a></td>
                       <td style=\"text-align:center;\">".$row->fullnm."</td>
                       <td style=\"text-align:center;\">".$row->sc_co."</td>
                       <td><div align=center>".number_format($row->ttp,0,"",".")."</div></td>
                       <td><div align=right>".number_format($row->totpay,0,"",".")."&nbsp;</div></td>
                       <td><div align=right>".number_format($row->totbv,0,"",".")."&nbsp;</div></td>
                       
                    </tr>";
					//<td><div align=center>".$bnsperiod."</div></td>
                    $totalDp += $row->totpay;
					$totaLBV += $row->totbv;
					$i++;
                }
                ?>
                    <tr>
                    	<td colspan="2">
                    		<input type="button" class="btn btn-success span20" onClick="Sales_sco.get_group_prod(); return false;" name="submit" value="Process" id="checkss"/>
                    	</td> 
                        <td colspan="4" style="text-align: right;">T O T A L</td>
                        <td style="text-align: right;"><?php echo number_format($totalDp,0,"",".");?>&nbsp;</td>
                        <td style="text-align: right;"><?php echo number_format($totaLBV,0,"",".");?>&nbsp;</td>
                        
                        
                    </tr>
                    
                </tbody>
            </table>
            <input type="hidden" name="typee" value="<?php echo $searchs;?>"/>
            <input type="hidden" name="bnsperiod" value="<?php echo $bnsperiod;?>"/>
            <input type="hidden" name="scDfno" value="<?php echo $idstkk;?>"/>
            
        </form>
    

<?php }?>
