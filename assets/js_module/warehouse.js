var $ = jQuery;

var wh = {
	changeSKProduct : function() {
		var prdcd = $(All.get_active_tab() + " #prdcdSK").val(); // voucherno
		
		
		if(prdcdSK !== "") {
		    var trxno = $(All.get_active_tab() + " #trxno").val(); // trx no/ NO MM
			var res = prdcd.split("**");
		
			var prdcdVal = res[0];
			var kitVal = res[1];
			var qtyReleased = parseInt(res[2]);
			var qtyRemain = parseInt(res[3]);
			var udDirelease = qtyReleased - qtyRemain;
			$(All.get_active_tab() + " #productcode").val(prdcdVal);
			$(All.get_active_tab() + " #qtyReleased").val(qtyReleased);
			$(All.get_active_tab() + " #qtyReleased2").val(udDirelease);
			$(All.get_active_tab() + " #qtyRemain").val(qtyRemain);
		    
			if(udDirelease > 0) {
				
					$(All.get_active_tab() + " #btnUpdVch").removeAttr("disabled");
				    $(All.get_active_tab() + " #vch_start").removeAttr("readonly");
					$.ajax({
						url : All.get_url('voucher/product/') + trxno + "/" +prdcdVal,
						type : 'GET',
						success : function(data) {
							
							$(All.get_active_tab() + " #listReleasedVch").html(null);
							$(All.get_active_tab() + " #listReleasedVch").html(data);
							
							if(qtyRemain == 0) {
								$(All.get_active_tab() + " #btnUpdVch").attr("disabled", "disabled");
								$(All.get_active_tab() + " #vch_start").attr("readonly", "readonly");
							}    
						}
				    });
				
			} else {
				$(All.get_active_tab() + " #listReleasedVch").html(null);
				$(All.get_active_tab() + " #btnUpdVch").removeAttr("disabled");
				$(All.get_active_tab() + " #vch_start").removeAttr("readonly");
			}
	    }		
	},
	
	checkValidQtyVch : function() {
		var qty = parseInt($(All.get_active_tab() + " #qtyReleased").val());
		var qtyRelease = parseInt($(All.get_active_tab() + " #qtyReleased2").val());
		var qtyRemain = parseInt($(All.get_active_tab() + " #qtyRemain").val());
		var vch_start = $(All.get_active_tab() + " #vch_start").val();
		var sisa = qty - qtyRelease;
		if(qtyRemain > sisa) {
			alert("Qty tidak boleh melebihi jumlah yang sudah di release");
			$(All.get_active_tab() + " #qtyRemain").val(sisa);
		} else {
			if(vch_start !== "") {
				wh.checkVchStart();
			}
		}
	},
	
	checkVchStart : function() {
		var vch_start = $(All.get_active_tab() + " #vch_start").val();
		var qtyRemain = $(All.get_active_tab() + " #qtyRemain").val();
		$.ajax({
				url : All.get_url('voucher/check/formno/') + vch_start + "/" +qtyRemain,
				dataType: 'json',
				type : 'GET',
				success : function(data) {
					
					if(data.response == "false") {
						alert("No Voucher sudah ada yang di release..");
						All.clear_div_in_boxcontent(" #listReleasedVch");
						var res = data.res;
						
						var rowhtml = "<table class='table table-striped table-bordered' width='70%' id='tblvchno'>";
							rowhtml += "<thead>";
						    rowhtml += "<tr><th colspan=17>DETAIL VOUCHER</th></tr>";
						    rowhtml += "<tr><th rowspan='2'>No#</th><th rowspan=2>Voucher#</th><th colspan=2>Released</th><th colspan=2>Distributor</th></tr>";
						    rowhtml += "<tr>";
							rowhtml += "<th>Name</th>";
							rowhtml += "<th>On</th>";
							rowhtml += "<th>Code</th>";
							rowhtml += "<th>Name</th>";
							rowhtml += "</tr>";
							rowhtml += "</thead><tbody id='mytbody'>";
						$.each(res, function(key, value) {
							rowhtml += "<tr>";
							rowhtml += "<td align=right>"+(key+1)+"</td>";
							rowhtml += "<td align=center>"+value.formno+"</td>";
							rowhtml += "<td align=center>"+value.updatenm+"</td>";
							rowhtml += "<td align=center>"+value.updatedt+"</td>";
							rowhtml += "<td align=center>"+value.activate_dfno+"</td>";
							rowhtml += "<td align=left>"+value.fullnm+"</td>";		 
						    rowhtml += "</tr>";
						});	
						rowhtml += "</tbody></table>";
						$(All.get_active_tab() + " #listReleasedVch").html(rowhtml);
						$(All.get_active_tab() + " #vch_end").val(null);
						$(All.get_active_tab() + " #btnUpdVch").attr("disabled", "disabled");
					} else {
						$(All.get_active_tab() + " #listReleasedVch").html(null);
						$(All.get_active_tab() + " #vch_end").val(data.res);
						$(All.get_active_tab() + " #btnUpdVch").removeAttr("disabled");
					}
				}	
					
		});	
	},
    
    updateReleaseVch : function() {
    	var trxno = $(All.get_active_tab() + " #trxno").val();
    	var trdt = $(All.get_active_tab() + " #trdt").val();
    	var receiptno = $(All.get_active_tab() + " #receiptno").val();
    	var receiptdt = $(All.get_active_tab() + " #receiptdt").val();
    	var stockist = $(All.get_active_tab() + " #stockist").val();
				
    	All.set_disable_button();
    	$.post(All.get_url("voucher/release"),$("#formReleaseVcr").serialize(), function(data)
        {
        	All.set_enable_button();
        	if(data.response == "true") {
        		alert(data.message);
        		//wh/releasevcr/det/MM1701000516**KW1701001530**13-01-2017**13-01-2017**IDSKS12 - K-SYSTEM JAMBI
        		var param = "voucher/detail/" + trxno + "**" +receiptno + "**" + receiptdt + "**" +  trdt + "**" +stockist;
        		All.ajaxShowDetailonNextForm(param);
        	} else {
        		alert(data.message);
        	}
        },"json").fail(function() {
			alert("Error requesting page");
			All.set_enable_button();
		});	
    }
}