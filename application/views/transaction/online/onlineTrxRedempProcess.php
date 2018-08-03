<?php
echo "
<form name=\"oke\" method=\"POST\" action=\"".site_url()."sales/ol/redemp/save\" target=\"_blank\">
<table width=\"80%\" align=\"center\" class=\"table table-striped table-bordered bootstrap-datatable datatable\">
      <tr>
        <th colspan=2>REKAP TRANSAKSI PEMBELANJAAN</th>
      </tr>
      <tr>
        <td width=\"20%\" >ID STOCKIST </td>
        <td>".$main[0]->idstk. " / ".$main[0]->nmstkk."</td>
        
      </tr>
      <tr>
        <td>ID MEMBER</td>
        <td>".$main[0]->id_memb. " / ".$main[0]->nmmember."</td>
		
      </tr>
      
      <tr>
        <td>USER LOGIN</td>
        <td>".$main[0]->usr_login. " / ".$main[0]->nmsponsor. " ( ". $main[0]->tel_hp. " ) "."</td>
		
      </tr>
      
      <tr>
        <td>NO TRANSAKSI</td>
        <td>".$main[0]->orderno."</td>
		
      </tr>
      <tr>
        <td>TOTAL HARGA</td>
        <td>".number_format($main[0]->total_pay,0,",",".")."</td>
		</tr>
      
      <tr>
        <td>PERIODE BONUS</td>
        <td>".$main[0]->bonusmonth."</td>
		
      </tr>
    </table>
    
	<table width=\"80%\" class=\"table table-striped table-bordered bootstrap-datatable datatable\" align=\"center\">
	  <tr>
        <th colspan=8>DETAIL PEMBELANJAAN PRODUK</th>
      </tr>
      <tr>
        <th width=\"4%\" >No</th>
        <th width=\"15%\" >Kode Produk</th>
        <th>Nama Produk</th>
        <th>Qty</th>
        <th width=\"10%\">DP</th>
        <th width=\"7%\">BV</th>
        <th width=\"10%\">Total DP </th>
        <th width=\"7%\">Total BV </th>
      </tr>
      <tr>";
$i = 0;
$totalldp = 0;
$totallbv = 0;
foreach($detail as $bar)
{
	$i++;
	$totDPR = ($bar->dpr * $bar->qty);
	$totBVR = ($bar->bvr * $bar->qty);
	echo "
        <td align=\"right\">$i</td>
        <td align=center>$bar->prdcd</td>
        <td>$bar->prdnm</td>
        <td align=\"right\">$bar->qty</td>
        <td align=\"right\">".number_format($bar->dpr,0,",",".")."</td>
        <td align=\"right\">".number_format($bar->bvr,0,",",".")."</td>
        <td align=\"right\">".number_format($totDPR,0,",",".")."</td>
        <td align=\"right\">".number_format($totBVR,0,",",".")."</td>";
        /*<td><input type=\"checkbox\" name=\"check[]\" value=\"$bar->prdcd\"></td>*/
      echo "</tr>";
	  $totalldp += ($bar->dpr * $bar->qty);
	  $totallbv += ($bar->bvr * $bar->qty);
}
	echo "
      <tr>
        <td colspan=\"6\"  align=\"center\"><b>TOTAL</b></td>
        <td align=\"right\">".number_format($totalldp,0,",",",")."</td>
        <td align=\"right\">$totallbv</td>
        
      </tr>
      <tr>
        <td  colspan=\"8\" align=\"center\" valign=\"center\">Security Code
        <input type=\"text\" name=\"secno\">&nbsp;
        <input type=\"button\" class=\"btn btn-mini btn-warning\" name=\"back\" value=\"<< Kembali\" onclick=\"All.back_to_form(' .nextForm1',' .mainForm')\" />
        <input type=\"submit\" class=\"btn btn-mini btn-primary\" name=\"updates\" value=\"Proses Pengambilan Barang\" />
        <input type=\"hidden\" name=\"orderno\" value=\"".$main[0]->orderno."\"/> 
        </td>
      </tr>
      
    </table>

</form>";
?>