<table style="width: 97%;" class="table table-striped table-bordered bootstrap-datatable datatable" align="center">
    <thead>
    	<tr bgcolor="#f4f4f4">
    	  <th colspan="8">DETAIL TRANSAKSI</th>	
    	</tr>
        <tr bgcolor="#f4f4f4">
            <th width="5%">No</th>
            <th width="13%">Stockist</th>
            <th width="13%">TTP</th>
            <th>ID Member</th>
            <th>Nama Member</th>
            <th width="8%">Tgl Trx</th>
            <th width="15%">Total Harga</th>
            <th width="10%">Total BV</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            $totalDp = 0;
            $totbv = 0;
            foreach($detailTtp as $row){
        ?>
        <tr>
            <td align="right"><?php echo $no;?> </td>
            <td align="center"><?php echo $row->sc_dfno;?></td>
            <td align="center"><?php echo $row->trcd;?> </td>
            <td><?php echo $row->dfno;?> </td> 
            <td><?php echo $row->fullnm;?> </td>
            <td align="center"><?php echo date('d/m/Y', strtotime($row->bnsperiod));?> </td>
            <td style="text-align: right;"><?php echo number_format($row->totpay,0,"",".");?> </td> 
            <td style="text-align: right;"><?php echo number_format($row->nbv,0,"",".");?> </td>      
        </tr> 
        <?php 
                $totalDp += $row->totpay;
                $totbv += $row->nbv;
                $no++;
            }
        ?>
        <tr>
        	<td colspan="2"><?php backToMainForm(); ?></td>
            <td colspan="4" align="center">TOTAL</td>
            <td style="text-align: right;"><?php echo number_format($totalDp,0,"",".");?></td>
            <td style="text-align: right;"><?php echo number_format($totbv,0,"",".");?></td>
        </tr>
        
    </tbody>
</table>

