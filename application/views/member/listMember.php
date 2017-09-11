<?php
    if(empty($result)){
        echo setErrorMessage();
    }else{
?>
    <table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
    <tr>
        <th class="no-sort">No.</th>
        <th>ID</th>
        <th>Nama</th>
        <th>No.KTP</th>
        <th>Stockist</th>
        <th>No. Handphone</th>

    </tr>
    </thead>
    <?php
        $no = 1;
        foreach($result as $row){
    ?>
    
    <tr>
       
        <td align=right ><?php echo $no;?></td>
        <td align=center><a href = "#" id=" <?php echo $row->dfno;?>" onclick="All.ajaxShowDetailonNextForm('member/id/<?php echo $row->dfno;?>')"><?php echo $row->dfno;?></a></td>
        <td><?php echo $row->fullnm;?></td>
        <td><?php echo $row->idno;?></td>
        <td align=center><?php echo $row->loccd;?></td>
        <td><?php echo $row->tel_hp;?></td>
        
            </tr>
    <?php
        $no++;
        }
    ?>
</table>
<?php
setDatatable();
    }
?>

