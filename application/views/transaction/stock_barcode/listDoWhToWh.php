<?php
if($result == null) {
	echo setErrorMessage("No Result Found..");
} else {	
?>
<form id="preparePL">
<table width="100%" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
        <tr style="background-color: #f4f4f4;"><th colspan="5">List DO Stockist</th></tr>
        <tr>
        	<th width="5%"><input type="checkbox" onclick="All.checkUncheckAll(this)" name="checkall" /></th>
            <th width="5%">No</th>
            <th width="20%">DO No</th>
            <th>Receipt No</th>
            <th width="15%">ID Member / Stockist</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            foreach($result as $row){
                $donoo = $row->trcd;
			$link = "stk/barcode/trx/id/".$donoo;	
        ?>
    
    <tr id="<?php echo $i; ?>">
    	<td align="center">
    		<input type="checkbox" id="pil<?php echo $i; ?>" name="pilih[]" value="<?php echo $row->trcd; ?>" />
    	</td>
        <td align="right"><?php echo $i; ?></td>
        <td align="center"><input type="hidden" id="trcd<?php echo $i; ?>" value="<?php echo $donoo; ?>" /><a id="<?php echo $donoo; ?>" onclick="javascript:All.ajaxShowDetailonNextForm('stk/barcode/trx/id/<?php echo $donoo; ?>')" ><?php echo $row -> trcd; ?></a></td>
        <td align="center"><?php echo $row -> receiptno; ?></td>
        <td align="center"><?php echo $row -> shipto; ?></td>
    </tr>
    <?php $i++;
		}
	?>
    </tbody>
</table>
<input type="hidden" id="whcode" name="whcode" value="<?php echo $sendTo; ?>" />
<input type="hidden" id="whname" name="whname" value="<?php echo $info; ?>" />            
<input type=button class="btn btn-primary" name=btn_submit value="Proceed >>" onclick="All.ajaxShowDetailonNextFormPost('stk/barcode/prepare/pl', this.form.id)"/> 
</form>
<?php 
setDatatable();
} ?>
