<?php
    if(empty($result)){
        echo setErrorMessage();
    }else{
?>
    <table width="100%" class="table table-striped table-bordered bootstrap-datatable">
    <tr>
      <td colspan="2"><b>MM No</b></td>
      <td colspan="4"><?php echo $result[0]->invoiceno; ?></td>	
    </tr>
    <tr>
      <td colspan="2"><b>Register No</b></td>
      <td colspan="4"><?php echo $result[0]->registerno; ?></td>	
    </tr>
    <tr>
      <td colspan="2"><b>Receipt No</b></td>
      <td colspan="4"><?php echo $result[0]->receiptno; ?></td>	
    </tr>
    <tr>
      <td colspan="2"><b>Batch No</b></td>
      <td colspan="4"><?php echo $result[0]->batchscno; ?></td>	
    </tr>
    <tr>
      <td colspan="2"><b>Batch Dt</b></td>
      <td colspan="4"><?php echo $result[0]->batchdt; ?></td>	
    </tr>
    <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Nama</th>
        <th>Join Date</th>
        <th>Sponsor</th>
        <th>Recruiter</th>

    </tr>
    
    <?php
        $no = 1;
        foreach($result as $row){
    ?>
    
    <tr>      
        <td align=right ><?php echo $no;?></td>
        <td align=center><a href = "#" id=" <?php echo $row->dfno;?>" onclick="All.ajaxShowDetailonNextForm('member/id/<?php echo $row->dfno;?>')"><?php echo $row->dfno;?></a></td>
        <td><?php echo $row->fullnm;?></td>
        <td align=center><?php echo $row->jointdt;?></td>
        <td align=center><a href = "#" id=" <?php echo $row->sponsorid;?>" onclick="All.ajaxShowDetailonNextForm('member/id/<?php echo $row->sponsorid;?>')"><?php echo $row->sponsorid;?></a></td>
        <td align=center><a href = "#" id=" <?php echo $row->sponsorregid;?>" onclick="All.ajaxShowDetailonNextForm('member/id/<?php echo $row->sponsorregid;?>')"><?php echo $row->sponsorregid;?></a></td>        
    </tr>
    <?php
        $no++;
        }
    ?>
</table>
<?php
    }
?>
