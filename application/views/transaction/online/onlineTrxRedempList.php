<?php
if(empty($trans))
    {
        echo setErrorMessage("No record found");
    }
    else
    {
?>
<table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable">
     <thead>
        <tr>
         <th width="3%">No</th>	
         <th width="8%">Order No</th>
         <th width="12%">ID Member</th>
         <th width="16%">Nama Member</th>
         <th width="6%">Total</th>
         <th width="6%">Bns Month</th>
         <th width="6%">Status</th>
         <th width="4%">Ket</th>
        </tr>
     </thead>
     <tbody>
      <?php
        $i = 1;
        foreach($trans as $data)
        {
        	   
            if($data->flag_trx == 'W')
            {
                $flags = "Website";
            }
            else
            {
                $flags = "Sms";
            }
            if($data->status == 0)
            {
                $stat = "Pending";
                 echo "
                      <tr>
                        <td align=right>$i</td>
                        <td align=center><a id=\"$data->orderno\" onclick=\"All.ajaxShowDetailonNextForm('sales/ol/orderno/$data->orderno')\">$data->orderno</a></td> 
                        <td align=center>$data->id_memb</td> 
                        <td>$data->nmmember</td> 
                        <td><div align=\"right\">".number_format($data->total_pay,0,".",",")."</td> 
                        <td align=center>".$data->bonusmonth."</td>
                        <td align=center>$stat</td>
                        <td align=center>$flags</td>
                      </tr>";
            }
            else
            {
                $stat = "Approve";
				 //<a id=\"$data->orderno\" onclick=\"All.ajaxShowDetailonNextForm('sales/ol/orderno/$data->orderno')\">$data->orderno</a>
                 $link = base_url("sales/ol/reprint"."/".$data->orderno);
                 echo "
                  <tr>
                    <td align=right>$i</td>
                    <td align=center>
                      <a href=\"$link\" target=\"_BLANK\">$data->orderno</a>
                    </td> 
                    <td align=center>$data->id_memb</td> 
                    <td>$data->nmmember</td> 
                    <td><div align=\"right\">".number_format($data->total_pay,0,".",",")."</td> 
                    <td align=center>".$data->bonusmonth."</td>
                    <td align=center>$stat</td>
                    <td align=center>$flags</td>
                  </tr>";
            }
			$i++;
      }
    ?>
    </tbody>
 </table>
<script type="text/javascript">
$(document).ready(function() 
{
	$(All.get_active_tab() + " .datatable").dataTable( {
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
		"sPaginationType": "bootstrap",
		"oLanguage": {
		},
        "bDestroy": true
	});
    $(All.get_active_tab() + " .datatable").removeAttr('style');
 });


</script>
<?php
}
?>