<?php
if($result == null) {
	echo setErrorMessage("No Result Found..");
} else {	
?>
<table width="90%" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
        <tr style="background-color: #f4f4f4;"><th colspan="4">List DO Stockist</th></tr>
        <tr>
            <th>No</th>
            <th>DO No</th>
            <th>Receipt No</th>
            <th>Stockist</th>
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
<?php 
setDatatable();
} ?>
