<?php
    if(empty($result)){
        echo setErrorMessage();
    }else{
?>
   
	<table style="width: 100%" class="table table-striped table-bordered bootstrap-datatable">
        <tr>
        	<th colspan="2">Detail Data Voucher Cash/Product</th>
        </tr>	
        <?php
            foreach($result as $row){
                $claimstatus = $row->claimstatus;
                $dfno = $row->DistributorCode;
				$fullnm = $row->fullnm;
                $vchno = $row->VoucherNo;
                $vchtype = $row->vchtype;
				$voucherkey = $row->voucherkey;
                $amount = $row->VoucherAmt;
                $expDate = $row->ExpireDate;
				$tglklaim = $row->tglklaim;
                $nowDate = $row->nowDate;
				$status_expire = $row->status_expire;
				$trcd = $row->trcd;
                $batchno = $row->batchno;
				$loccd = $row->loccd;		
          	}
        ?>	
        	
        	
			<tr>
                <td style="width: 20%">No Voucher</td>
                <td><?php echo $vchno;?></td>       
            </tr>
            <tr>
                <td style="width: 20%">Voucher Key</td>
                <td><?php echo $voucherkey;?></td>       
            </tr>
            <tr>
                <td>Tipe Voucher</td>
                <td>
                	<?php 
                	if($vchtype == "C") {
                		echo "VOUCHER CASH";
                	} else if($vchtype == "P") {
                		echo "VOUCHER PRODUCT";
                	} else {
                		echo "--";
                	}
                	?>
                </td>       
            </tr>
            <tr>
                <td style="width: 20%">ID Member</td>
                <td><?php echo $dfno. " / ".$fullnm;?></td>       
            </tr>
            <tr>
                <td style="width: 20%">Nilai Voucher</td>
                <td><?php echo number_format($amount,2,",",".");?></td>       
            </tr>
            <tr>
                <td>Expire Date</td>
                <td>
                	 <?php ;
                	  if($status_expire == "1") {
                	  	 echo "<font color=red>* Voucher sudah expired</font>";
                	  } 
					  echo " ".$expDate;
                	 ?>
                </td>  
            </tr>
            <tr>
                <td>Status Klaim</td>
                <td>
                	 <?php 
                	 //echo $updatedt. " ";
                	  if($claimstatus == "1") {
                	  	 echo "<font color=red>* Voucher sudah di klaim</font>";
						 echo " ".$tglklaim; 
                	  } else {
                	  	 echo "Belum di klaim";
                	  }
                	 ?>
                </td>  
            </tr>
            <tr>
                <td>No Trx</td>
                <td>
                	<?php echo $trcd; ?>
                </td>  
            </tr>
            <tr>
                <td>No Batch</td>
                <td>
                	<?php echo $batchno; ?>
                </td>  
            </tr>
            <tr>
                <td>ID Stockist</td>
                <td>
                	<?php echo $loccd; ?>
                </td>  
            </tr>
			
</table>

	
<?php
echo backToMainForm();
    }
?>