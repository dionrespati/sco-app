<?php

if ($voucherno != null) {
    echo "<table class='table table-striped table-bordered' width='80%' id='tblvchno'>
		<thead>
		  <tr><th colspan=17>DETAIL VOUCHER</th></tr>
		  <tr><th rowspan='2'>No#</th><th rowspan=3>Voucher#</th><th colspan=2>Released</th><th colspan=3>Distributor</th></tr>
		  <tr>
			<th>Name</th>
			<th>On</th>
			<th>Code</th>
			<th>Name</th>
			<th>Activate At</th>
		  </tr>
		 </thead><tbody id='mytbody'>";

    $i = 1;
    //var_dump($voucherno);
    //echo "count = ".count($voucherno);

    foreach ($voucherno as $data) {

        //a.sold_trcd, a.formno, a.updatenm, a.updatedt, a.activate_dfno, b.fullnm
        $sold_trcd = $data->sold_trcd;
        $formno = $data->formno;
        $updatenm = $data->updatenm;
        $updatedt = $bnsperiod = date("d-M-y", strtotime($data->updatedt));
        $dfno = $data->activate_dfno;
        $fullnm = $data->fullnm;
        $status = $data->status;

        //var_dump($voucherno);

        echo "<tr>
                    <td align=right>$i</td>
                    <td align=center>$formno</td>
                    <td align=center>$updatenm</td>
                    <td align=center>$updatedt</td>
                    <td align=center>$dfno</td>
                    <td align=left>$fullnm</td>
                    <td align=center>$data->activate_dt</td>				 
              </tr>";
        $i++;
    }


    echo "</tbody></table>";
}
?>