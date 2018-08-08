<?php
  $title = "width: 10%";
?>
<table style="width: 100%" class="table table-striped table-bordered bootstrap-datatable datatable">
        <tr>
        	<th colspan="2">
        		<?php
        		   echo " INFORMASI ";
        		   if($this->groupid == "3") {	
        		   	   echo "STOCKIST ";	
        		   } else if($this->groupid == "4") {
        		   	   echo "SUB STOCKIST ";
        		   } else {
        		   	   echo "BRANCH / MASTER STOCKIST ";
        		   }
				   
        		?>
        	</th>
        </tr>	
       <tr>
            <td style="<?php echo $title; ?>">Kode Stockist</td>
            <td style="width: 38%"><?php echo $result[0]->loccd; ?></td>
       </tr>
       <tr>      
            <td>Nama Stockist</td>
            <td><?php echo $result[0]->fullnm; ?></td>
       </tr>
       <tr>      
            <td>Alamat</td>
            <td><?php echo $result[0]->addr1; ?></td>
       </tr>
      
       <tr>      
            <td>&nbsp;</td>
            <td><?php echo $result[0]->addr2; ?></td>
       </tr>
       <tr>      
            <td>&nbsp;</td>
            <td><?php echo $result[0]->addr3; ?></td>
       </tr>
       <tr>      
            <td>Lat / Long Location</td>
            <td><?php echo $result[0]->latitude.", ".$result[0]->longitude; ?></td>
       </tr>
        <tr>      
            <td>State/Area</td>
            <td><?php echo $result[0]->statenm." (".$result[0]->state.")"; ?></td>
       </tr>
       <tr>      
            <td>No HP</td>
            <td><?php echo $result[0]->tel_hp; ?></td>
       </tr>
       <tr>      
            <td>No Telp Rumah</td>
            <td><?php echo $result[0]->tel_hm; ?></td>
       </tr>
       <tr>      
            <td>No Telp Kantor</td>
            <td><?php echo $result[0]->tel_of; ?></td>
       </tr>
       <tr>      
            <td>Upline Stockist</td>
            <td><?php echo $result[0]->uplinestk." / ".$result[0]->uplinenm; ?></td>
       </tr>
       <tr>      
            <td>ID Pemilik Stockist</td>
            <td><?php echo $result[0]->dfno; ?></td>
       </tr>
        <tr>      
            <td>AR Starterkit</td>
            <td><?php echo $result[0]->arkit; ?>&nbsp;&nbsp;&nbsp;<font color="red">* Jumlah Starterkit Pending Voucher yang sudah dipakai</font></td>
       </tr>
        <tr>      
            <td>Limit Starterkit</td>
            <td><?php echo $result[0]->limitkit; ?></td>
       </tr>
</table>