<?php
    $pdf=new FPDF('P','mm', 'A4');
    $pdf->Open();
    $pdf->SetFillColor(255,255,255); // background = biru muda
    $pdf->SetTextColor(0,0,0);	 //	font color = black
    $pdf->SetDrawColor(0,0,0); // border 	   = brown	
    $pdf->SetLineWidth(.1);
    $pdf->AddPage();
    
    
    $pdf->Ln();
    //$pdf->SetXY(10,50);
    
    //tinggi column
    $lebarCell = 4;
     
    //setting header
    $column_header = 25;
    $column_data = 100;
    
    //setting header product column width
    $no_urut = 10;
    $product_id = 20;
    $product_name = 80;
    $qty = 10;
    $dp = 20;
    $bv = 15;
    $kolom_total = $no_urut + $product_id + $product_name + $qty + $dp + $bv;
    $total_dp = 25;
    $total_bv = 15;
    $pdf->SetFont('Courier','B', 10);
    $pdf->Cell(195,5,"FAKTUR PENGAMBILAN BARANG PEMBELANJAAN ONLINE",0,0,'C', true);
    $pdf->SetFont('Courier','', 8);
    $pdf->Ln();
    $pdf->Ln();
    foreach($main as $dta2)
    {
        $rowdates = date('d/m/Y',strtotime($dta2->datetrans));
        
       $pay = number_format($dta2->total_pay,0,".",",");
       $pdf->Cell($column_header,$lebarCell,"ID STOCKIST",0,0,'L',true); 	
       $pdf->Cell($column_data,$lebarCell,": $dta2->idstk / $dta2->nmstkk",0,0,'L',true);
       $pdf->Ln();
       $pdf->Cell($column_header,$lebarCell,"ID MEMBER",0,0,'L',true); 	
       $pdf->Cell($column_data,$lebarCell,": $dta2->id_memb / $dta2->nmmember",0,0,'L',true);
       $pdf->Ln();
       $pdf->Cell($column_header,$lebarCell,"ORDER NO",0,0,'L',true); 	
       $pdf->Cell($column_data,$lebarCell,": $dta2->orderno",0,0,'L',true);
       $pdf->Ln();
       $pdf->Cell($column_header,$lebarCell,"TOTAL PAY",0,0,'L',true); 	
       $pdf->Cell($column_data,$lebarCell,": $pay",0,0,'L',true);
       $pdf->Ln();
       $pdf->Cell($column_header,$lebarCell,"BONUS MONTH",0,0,'L',true); 	
       $pdf->Cell($column_data,$lebarCell,": $dta2->bonusmonth",0,0,'L',true);
       $pdf->Ln();
    }    
    
    $pdf->Ln();
    
    //Header Product Detail
    $pdf->Cell(195,5,"KODE PRODUK : $kode_prod",0,0,'L', true);
    $pdf->Ln();
    $pdf->Cell($no_urut,$lebarCell,"No",1,0,'C',true); 	
    $pdf->Cell($product_id,$lebarCell,"ID Product",1,0,'C',true);
    $pdf->Cell($product_name,$lebarCell,"Product Name",1,0,'C',true);
    $pdf->Cell($qty,$lebarCell,"Qty",1,0,'C',true);
    $pdf->Cell($dp,$lebarCell,"DP",1,0,'C',true);
    $pdf->Cell($bv,$lebarCell,"BV",1,0,'C',true);
    $pdf->Cell($total_dp,$lebarCell,"Total DP",1,0,'C',true);
    $pdf->Cell($total_bv,$lebarCell,"Total BV",1,0,'C',true);
    $pdf->Ln(); 
    $x = 1;
    
    $total_dpR = 0;
    $total_bvR = 0;
    foreach($hasil as $dta2)
    {
        //$dpR = $dta2->total_dp / $dta2->qty;
        //$bvR = $dta2->total_bv / $dta2->qty;
        
        $subs = substr($dta2->prdnm,0,3);
        $a = str_split($subs);
        
        if(in_array('(*)',$a))
        {
            $quantity = $qtys;
            echo $quantity;
        }
        else
        {
            $quantity = $dta2->qty;
            
        }
        
        
        $pdf->Cell($no_urut, $lebarCell,$x,1,0,'C',true); 	
        $pdf->Cell($product_id, $lebarCell,"$dta2->prdcd",1,0,'C',true);
        $pdf->Cell($product_name, $lebarCell,"$dta2->prdnm",1,0,'L',true);
        $pdf->Cell($qty, $lebarCell,"".$quantity."",1,0,'R',true);
        $pdf->Cell($dp, $lebarCell,number_format($dta2->dp,0,".",","),1,0,'R',true);
        $pdf->Cell($bv, $lebarCell,number_format($dta2->bv,0,".",","),1,0,'R',true);
        $pdf->Cell($total_dp, $lebarCell,number_format($dta2->totdp,0,".",","),1,0,'R',true);
        $pdf->Cell($total_bv, $lebarCell,number_format($dta2->totbv,0,".",","),1,0,'R',true);
        $pdf->Ln();
        
        //$total_qty += $dta2->qty;
        $total_dpR += $dta2->totdp;
        $total_bvR += $dta2->totbv;
        $x++;
    }
    
    
    $pdf->Cell($kolom_total,$lebarCell,"TOTAL PEMBELANJAAN",1,0,'L',true);
    $pdf->Cell($total_dp,$lebarCell,number_format($total_dpR,0,".",","),1,0,'R',true);
    $pdf->Cell($total_bv,$lebarCell,number_format($total_bvR,0,".",","),1,0,'R',true);
    $ss = date('d M Y h:i:s');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(195,3,"$user  $ss",0,0,'R', true);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(195,3,"PLEASE TAKE NOTE",0,0,'L', true);
    $pdf->Ln();
    $pdf->Cell(195,3,"* Barang Sudah Diambil Pada ".$rowdates."",0,0,'L', true);
    $pdf->Ln();
    $pdf->Cell(195,3,"* Barang yang sudah di beli tidak dapat ditukar",0,0,'L', true);
    $pdf->Ln();
    $pdf->Cell(195,3,"* Barang tidak dikirim tetapi diambil di stokis yang telah di pilih",0,0,'L', true);
    $pdf->Ln();    
    $pdf->Output();

?>