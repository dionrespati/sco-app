<?php
    if(empty($show_new_member)){
        echo setErrorMessage("No result found");
    }else{
?>
   <table width="70%" class="table table-striped table-bordered bootstrap-datatable">
        <tr>
        	<th colspan="2">Data Member</th>
        </tr>	
        <tr>
            <td width="20%">ID Member</td>
            <td><?php echo $show_new_member[0]->dfno;?></td>
        </tr>     
        <tr>
            <td width="30%">Nama Member</td>
            <td><?php echo $show_new_member[0]->fullnm;?></td>
        </tr>
        <tr>
            <td width="30%">Password</td>
            <td><?php echo $show_new_member[0]->password;?></td>
        </tr>
         <tr>
            <td width="30%">Rekruiter</td>
            <td><?php echo $show_new_member[0]->sfno_reg." / ".$show_new_member[0]->rekruiternm;?></td>
        </tr>
         <tr>
            <td width="30%">Sponsor</td>
            <td><?php echo $show_new_member[0]->sponsorid." / ".$show_new_member[0]->sponsorname;?></td>
        </tr>  
</table>
	<p></p>
	<div>
		 <input value="<< Input Member Baru" type="button" class="btn btn-small btn-warning" onclick="All.show_mainForm_after_process()"/>
		 <!--<input type="button" value="Save Changes" class="btn btn-small btn-primary" onclick="be_member.updateDataMember()" />-->
    </div>
	<p></p>
	
<?php
    }
?>