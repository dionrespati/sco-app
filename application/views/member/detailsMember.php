<?php
    if(empty($result)){
        echo setErrorMessage();
    }else{
?>
   
	<table style="width: 100%" class="table table-striped table-bordered bootstrap-datatable">
        <tr>
        	<th colspan="4">Detail Data Member</th>
        </tr>	
        <?php
            foreach($result as $row){
                $dfno = $row->dfno;
                $fullnm = $row->fullnm;
                $idno = $row->idno;
                $addr1 = $row->addr1;
                $addr2 = $row->addr2;
                $addr3 = $row->addr3;
                $tel_hp = $row->tel_hp;
				$tel_hm = $row->tel_hm;
                $sex = $row->sex;
				$birthdt = $row->birth;
				$join = $row->datejoin;
				$country = $row->country;
				$idsp = $row->idsponsor;
				$spnm = $row->sponsorname;
				$stckst = $row->stockist;
				$email = $row->email;
				$pass = $row->password;
                $novac = "88146-".$row->novac;
                $userinput = $row->createnm;
                $recruiter = $row->recruiter;
                $recruitnm = $row->recruiternm;			
          	}
        ?>	
        	
        	
			<tr>
                <td style="width: 13%">ID Member</td>
                <td style="width: 38%"><?php echo $dfno;?></td>
                 
                <td style="width: 13%">ID No</td>
                <td style="width: 38%"><?php echo $idno;?></td>
            </tr>
			<tr>
                <td>Member Name</td>
                <td><?php echo $fullnm;?></td>
            	 
            	<td>Sex</td>
            	<td><?php echo $sex;?></td>
            </tr>
			<tr>
                <td valign="top">Address</td>
                <td valign="top"><?php echo $addr1." ".$addr2." ".$addr3;?></td>
				 
            	<td valign="top">Cell Phone</td>
                <td valign="top"><?php echo $tel_hp;?></td>
            </tr>
			<tr>
                <td>ID Sponsor</td>
                <td><?php echo $idsp." / ".$spnm;?></td>
				 
            	<td>Birth Date</td>
                <td><?php echo $birthdt;?></td>
            </tr>
			<tr>
                <td>ID Recruiter</td>
                <td><?php echo $recruiter." / ".$recruitnm;?></td>
                 
            	<td>Join Date</td>
            	<td><?php echo $join;?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><?php echo $tel_hp;?></td>
                
                <td>City</td>
                <td><?php echo $country;?></td>
            </tr>
            <tr>
                <td>Registered in</td>
                <td id="upd_loccd"><?php echo $stckst;?></td>
				 
            	<td>Card & Bonus Stt</td>
                <td id="upd_bnsstmt"><?php echo $row->bnsstmsc;?></td>
            </tr>
            <?php
              if($this->stockist == "BID06") {
            ?>
			<tr>
                <td>Password</td>
                <td><?php echo $pass;?></td>
                <td>Email</td>
                <td><?php echo $email;?></td>
            </tr>
            <?php
			  } else {
			  	//echo "stk ".$this->stockist;
            ?>
            <tr>
                <td>Password</td>
                <td>&nbsp;</td>
                <td>Email</td>
                <td><?php echo $email;?></td>
            </tr>
            <?php
			  }
            ?>
            <tr>
                <td>No. VA</td>
                <td><?php echo $novac;?></td>
                <td>Input By</td>
                <td><?php echo $userinput;?></td>
            </tr>
             <tr>
                <td>Voucher No</td>
                <td><?php echo $result[0]->formno;?></td>
                <td>Voucher Key</td>
                <td><?php echo $result[0]->vchkey;?></td>
            </tr>
            <tr>
                <td>Registered using</td>
                <td><?php echo $result[0]->keteranganx;?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td><?php backToMainForm(); ?></td>
            	<td colspan="3">&nbsp;</td>
            </tr>
</table>

	
<?php
    }
?>