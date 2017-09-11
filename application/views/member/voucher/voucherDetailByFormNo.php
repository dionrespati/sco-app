<?php
  $title = "width: 10%";
  if($result == null) {
  	  echo setErrorMessage("Invalid Voucher No");
  } else {
?>

<table style="width: 70%" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
        <tr>
        	<th colspan="2">
        		Voucher Detail
        	</th>
        </tr>	
       
       <tr>      
            <td width="25%">Voucher No</td>
            <td><?php echo $result[0]->formno; ?></td>
       </tr>
       <tr>      
            <td>Voucher Key</td>
            <td><?php echo $result[0]->vchkey; ?></td>
       </tr>
       <tr>      
            <td>Product</td>
            <td><?php echo $result[0]->prdcd." - ".$result[0]->prdnm; ?></td>
       </tr>
       <tr>      
            <td>MM No</td>
            <td><?php echo $result[0]->sold_trcd; ?></td>
       </tr>
       
       <tr>      
            <td>Activate ID</td>
            <td><?php echo $result[0]->activate_dfno.  " / ".$result[0]->nama_member_aktif; ?></td>
       </tr>
       <tr>      
            <td>Activate By</td>
            <td><?php echo $result[0]->activate_by; ?></td>
       </tr>
       <tr>      
            <td>Status</td>
            <td>
            	<?php 
            	  if($result[0]->status == "0") {
            	  	$str = "UNRELEASED";
            	  } else if($result[0]->status == "1") {
            	  	$str = "RELEASED";
            	  } else if($result[0]->status == "2") {
            	  	$str = "ACTIVATED";
            	  }
				  echo $str;
            	?>
            	
            	
            </td>
       </tr>
      
</table>
<?php
}
?>