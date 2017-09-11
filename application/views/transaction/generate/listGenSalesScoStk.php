<?php if(empty($idstk)){
        echo "<div align=center class='alert alert-error'>No Record found..!!</div>";
    }else{
?>

<div class="row-fluid">
    <div class="span12">
        <form id="generateSaless" method="post" >
            <table style="width: 95%;" class="table table-striped table-bordered bootstrap-datatable datatable" align="center">
                <thead>
                	<tr>
                		<?php 
                			$bnsperiod = date('d/m/Y', strtotime($idstk[0]->bnsperiod));
                		?>
                		<th colspan="10">DAFTAR TRANSAKSI STOCKIST (Periode Bonus : <?php echo $bnsperiod; ?>)</th>
                	</tr>
                    <tr bgcolor="#f4f4f4">
                        <th width="5%"><input type="checkbox" name="checkall" onclick="All.checkUncheckAll(this)"/></th>
                        <th width="5%">No</th>
                        <th>Trx No</th>
            			<th>ID Member</th>
                        <th>Nama Member</th>
                        <th><?php echo $tipess;?></th>
                        <th width="10%">Tgl Trx</th>
                        <th width="15%">Total Harga</th>
                        <th width="10%">Total BV</th>
                        <!--<th>Periode Bonus</th>-->
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                $totalDp = 0;
				$totalBV = 0;
                foreach($idstk as $row)
                {
                    $trxdate = date('d/m/Y', strtotime($row->etdt));
                    $bnsperiod = date('d/m/Y', strtotime($row->bnsperiod));
                    echo "
                    <tr>
                        <td align=center>
                        <input type=checkbox id=cek[] name=cek[] value=\"".$row->trcd."\" />
                        </td>
                        <td style=\"text-align:right;\">$i</td>
                       <td align=center>$row->trcd</td>
                       <td>$row->dfno</td>
                       <td>$row->fullnm</td>
                       <td style=\"text-align:center;\">$row->sc_dfno</td>
                       <td><div align=center>$trxdate</div></td>
                       <td><div align=right>".number_format($row->totpay,0,"",".")."</div></td>
                       <td><div align=right>".number_format($row->nbv,0,"",".")."</div></td>
                       
                    </tr>";
					//<td><div align=center>$bnsperiod</div></td>
                    $totalDp += $row->totpay;
					$totalBV += $row->nbv;
					$i++;
                }
                ?>
                    <tr>
                    	<td colspan="2"><input type="button" class="btn span20 btn-success" onClick="All.ajaxShowDetailonNextFormPost('',this.form.id);" name="submit" value="Process" id="checkss"/></td>
                        <td colspan="5" style="text-align: right;"><b>T O T A L</b></td>
                        <td style="text-align: right;"><?php echo number_format($totalDp,0,"",".");?></td>
                        <td style="text-align: right;"><?php echo number_format($totalBV,0,"",".");?></td>
                        
                    </tr>
                    
                </tbody>
            </table>
            <input type="hidden" name="typee" value="<?php echo $searchs;?>"/>
            <input type="hidden" name="bnsperiod" value="<?php echo $bnsperiod;?>"/>
            <input type="hidden" name="scDfno" value="<?php echo $idstkk;?>"/>
            
        </form>
    </div>  
</div>
<?php }?>
