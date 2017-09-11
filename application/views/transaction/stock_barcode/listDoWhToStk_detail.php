<?php
$header = $result['header'];
//print_r($result);
?>
<form>
 <table style="width: 100%;" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
        <tr style="background-color: #f4f4f4;"><th colspan="7">Detail Transaction</th></tr>
        <tr>
            <td colspan="2">DO No</td>
            <td colspan="5">
            	<input type="hidden" id="trcd" name="dono" value="<?php echo $header[0]->trcd; ?>"/>
            	<?php echo $header[0]->trcd; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Stockist Code</td>
            <td colspan="5">
            	<input type="hidden" id="loccdTo" name="loccdTo" value="<?php echo $header[0]->shipto; ?>"/>
            	<?php echo $header[0]->shipto; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">Stockist Name</td>
            <td colspan="5">
            	<?php echo $header[0]->fullnm; ?>
            </td>
        </tr>
        <tr style="background-color: #f4f4f4;" >
            <th>&nbsp;No</th>
            <th>&nbsp;Product Code</th>
            <th>&nbsp;Product Name</th>
            <th>&nbsp;Qty Order</th>
            <th>&nbsp;Qty Barcode</th>
            <th>&nbsp;Qty Remain</th>
            <th>&nbsp;View</th>
        </tr>
        <?php
            $i = 1;
            $selisih = 0;
            $total = 0;
            foreach($result['detail'] as $list)  {
                $selisih = $list->qtyord - $list->qty_bc;
        ?>
        <tr>
            <td align="right">&nbsp;<?php echo $i; ?></td>
            <?php if($list->qty_bo > 0) { ?>
                <td align="center">&nbsp;
                	<input type="hidden" id="SLH" name="SLH" value="<?php echo $selisih; ?>"/>
                    <input type="hidden" id="qty" name="qty" value="<?php echo $list -> qtyord; ?>"/>
                    <input type="hidden" id="prdnm" name="prdnm" value="<?php echo $list -> prdnm; ?>"/>
                    <a id="<?php echo $list -> prdcd; ?>" onclick="javascript:Stkbarcode.scanToBarcodePrdStk('<?php echo $selisih; ?>','<?php echo $list -> prdcd; ?>','<?php echo $header[0]->shipto; ?>','<?php echo $list -> qtyord; ?>','<?php echo $header[0]->trcd; ?>','<?php echo $list -> prdnm; ?>');"><?php echo $list -> prdcd; ?></a>
                </td>
            <?php }else{ ?>
                <td align="center">&nbsp;<?php echo $list -> prdcd; ?></td>
            <?php } ?>
            <td>&nbsp;<?php echo $list -> prdnm; ?></td>
            <td align="right">&nbsp;<?php echo $list -> qtyord; ?></td>
            <td align="right">&nbsp;<?php echo $list -> qty_bc; ?></td>
            <td align="right">&nbsp;<?php echo $selisih; ?></td>
            <?php if($list->qty_bc > 0) { ?>
            <td align="center">&nbsp;
            	<input type="hidden" id="prdcd<?php echo $i;?>" name="prdcd[]" value="<?php echo $list -> prdcd; ?>"/>
            	<a class="btn btn-mini btn-success" onclick="javascript:Stkbarcode.getListProductBarcode(<?php echo $i; ?>)">View Barcode</a></td>
            <?php } else {?>
            <td align="center">&nbsp;</td>	
            <?php }?>	
        </tr>
        <?php $i++;
			$total += $list -> qtyord;
			}
		?>
    </thead>
    <!--<tr>
        <td colspan="3">Total Qty Order</td>
        <td ><?php echo $total; ?></td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
    </tr>-->
  </table>
<?php backToMainForm(); ?>
</form>