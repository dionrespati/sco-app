var $ = jQuery;

var Member = {
	selectBank : function() {
		if( $(All.get_active_tab() + "#bank").val() == "")
    {
        $(All.get_active_tab() + "#norek").val('');
        $(All.get_active_tab() + "#norek").attr('disabled', 'disabled');
        $(All.get_active_tab() + "#bnstmt").focus();
    }
    else
    {
        $("#norek").removeAttr('disabled');
        $(All.get_active_tab() + "#norek").focus();
    }
	},
	
	optionMemberSearch : function(nilai) {
		if(nilai == "tel_hp" || nilai == "dfno" || nilai == "fullnm" || nilai == "idno" || nilai == "sfno" || nilai == "sfno_reg" || nilai== "mm") {
			$(All.get_active_tab() + " .listM").css("display", "block");
			$(All.get_active_tab() + " .listByDate").css("display", "none");		
		} else if(nilai == "jointdt" || nilai == "batchdt") {
			$(All.get_active_tab() + " .listM").css("display", "none");
			$(All.get_active_tab() + " .listByDate").css("display", "block");
		} 
	},
	
	checkLbcByID : function(idmember) {
		if(idmember === "") {
			alert("ID Member harus diisi..");
		} else {
			All.set_disable_button();
			$.ajax({
	            url: All.get_url("lbc/id/" +idmember) ,
	            type: 'GET',
				dataType: 'json',
	            success:
	            function(data){
	                All.set_enable_button();
					if(data.response == "true" || data.response == "pass") {
						All.set_enable_button();
					
						$(All.get_active_tab() + " #nmmember").val(data.arrayData[0].fullnm);
						$(All.get_active_tab() + " #dob").val(data.arrayData[0].birthdt);
						$(All.get_active_tab() + " #idno").val(data.arrayData[0].idno);
						$(All.get_active_tab() + " #email").val(data.arrayData[0].email);
						$(All.get_active_tab() + " #bnsstmsc").val(data.arrayData[0].bnsstmsc);
						$(All.get_active_tab() + " #stockistname").val(data.arrayData[0].stockistname);
						$(All.get_active_tab() + " #fullnm").val(data.arrayData[0].fullnm);
						$(All.get_active_tab() + " #addr1").val(data.arrayData[0].addr1);
						$(All.get_active_tab() + " #addr2").val(data.arrayData[0].addr2);
						$(All.get_active_tab() + " #addr3").val(data.arrayData[0].addr3);
						
						$(All.get_active_tab() + " #c_addr1").val(data.arrayData[0].addr1);
						$(All.get_active_tab() + " #c_addr2").val(data.arrayData[0].addr2);
						$(All.get_active_tab() + " #c_addr3").val(data.arrayData[0].addr3);
						
						$(All.get_active_tab() + " #tel_hp").val(data.arrayData[0].tel_hp);
						$(All.get_active_tab() + " #tel_of").val(data.arrayData[0].tel_of);
						$(All.get_active_tab() + " #tel_hm").val(data.arrayData[0].tel_hm);
					} else {
						alert(data.message);
						All.reset_all_input();
					}
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                 alert(thrownError + ':' +xhr.status);
					 All.set_enable_button();
	            }
	        });
	   }     
	},
	
	voucherCheck : function() {
		var vchno = $(All.get_active_tab() + " #voucherno").val();
		var vchkey = $(All.get_active_tab() + " #voucherkey").val();
		if(vchno !== "" && vchkey !== "") {
			All.set_disable_button();
			var urlx = "member/voucher/check/" +vchno+ "/" +vchkey;
			$.getJSON(urlx, function(data) {
				All.set_enable_button();
			    if(data.response == "unreleased" || data.response == "false") {
			    	alert(data.message);
			    	All.set_disable_button();
			    	$(All.get_active_tab() + " .vchresult").html(null);
			    	$(All.get_active_tab() + " #validVoucher").val("0");
			    } else if(data.response == "activated") { 
			    	alert(data.message);
			    	All.set_disable_button();
			    	$(All.get_active_tab() + " #validVoucher").val("0");
			    	
			    	var arrayData = data.arrayData;
			    	var htmlx = "<table width='50%' class='table table-bordered table-striped'>";
			    	htmlx += "<thead><tr><th colspan=2>Data Voucher</th></tr></thead>";
			    	htmlx += "<tbody><tr><td>Voucher No</td><td>"+arrayData[0].formno+"</td></tr>";
			    	htmlx += "<tr><td>Activate ID</td><td>"+arrayData[0].activate_dfno+ " / " +arrayData[0].fullnm+"</td></tr>";
			    	htmlx += "<tr><td>Activate By</td><td>"+arrayData[0].activate_by+"</td></tr>";
			    	htmlx += "<tr><td>Activate Date</td><td>"+arrayData[0].activate_dt+"</td></tr>";
			    	htmlx += "</tbody></table>";
			    	$(All.get_active_tab() + " .vchresult").html(null);
			    	$(All.get_active_tab() + " .vchresult").html(htmlx);
			    } else {
			    	$(All.get_active_tab() + " .vchresult").html(null);
			    	$(All.get_active_tab() + " #validVoucher").val("1");
			    }
			});
		} else {
			
		}
	},
	
	inputMember : function() {
		var validVoucher = $(All.get_active_tab() + " #validVoucher").val();
		var vchno = $(All.get_active_tab() + " #voucherno").val();
		var vchkey = $(All.get_active_tab() + " #voucherkey").val();
		var idrekruit = $(All.get_active_tab() + " #idrekruit").val();
		var idsponsor = $(All.get_active_tab() + " #idsponsor").val();
		var sisaPendingVch = parseInt($(All.get_active_tab() + " #sisaPendingVch").val());
		var choosevoucher = $(All.get_active_tab() + " #choosevoucher").val();
		//check ID rekrut dan sponsor harus diisi
		if(idrekruit !== "" && idsponsor !== "") {
			//jika memilih tipe voucher
			if(choosevoucher == "1" && (validVoucher != "1" || vchno === "" || vchkey === "")) {
				alert("Cek No Voucher dan Voucher Key..");
			} else {
				if(sisaPendingVch == 0) {
					alert("Kuota untuk penginputan member pending voucher sudah habis..");
				} else {
					All.set_disable_button();
				    All.ajaxShowDetailonNextFormPost("member/reg/input","formCheckVoucher");	
				}
				
				
			}
		} else {
			alert("ID sponsor dan ID Rekruiter harus diisi..");
		}
		
	},
	
	checkDoubleInputMemb: function(url, param, paramValue) {
    	if(paramValue !== "") {
	    	All.set_disable_button();
			All.get_wait_message();
			$.ajax({
	            url: All.get_url(url + param+"/" +paramValue),
	            type: 'GET',
				dataType: 'json',
	            success:
	            function(data){
	                All.set_enable_button();
	                if(data.response == "false") {
						alert(data.message);
					} 
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                 alert(thrownError + ':' +xhr.status);
					 All.set_enable_button();
	            }
	        });
	    } else {
	    	alert("Field harus diisi..");
	    }  
    },
    
    checkBirthday : function (){
        
        var str = $(All.get_active_tab() + " #tgllahir").val();
        var age = str.substr(6,4);
        var dateCheck = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(str);
        
        var d = new Date();
        var yearnow = d.getFullYear();
        
        if(str == '')
        {
            alert('Tanggal Lahir Tidak Boleh Kosong');
            $(All.get_active_tab() + " #tgllahir").focus();            
        }
                        
        if(!dateCheck)
        {
            alert('Format Tanggal Lahir Salah');
            $(All.get_active_tab() + " #tgllahir").focus();
            //$("#submitted").attr("disabled", "disabled");
        }
        else
        {
            $(All.get_active_tab() + " #tgllahir").focus();
            //$("#submitted").removeAttr("disabled");
        }
        
        if(yearnow - age < 18 || age == '')
        {
            alert("Usia minimal adalah 18 tahun..");
            $(All.get_active_tab() + " #tgllahir").focus();
        }
    }, 
    
    setAreaBnsStatement : function() {
    	var area = $(All.get_active_tab() + " #area").val();
    	if(area != "") {
    		$(All.get_active_tab() + " #stkarea").val(area);
    		Member.listStockistByArea(area,'#bnstmt');
    	}
    },
    
    listStockistByArea : function(area, setTo) {
    	All.set_disable_button();
    	var urlx = 'member/list/stk/'+ area;
    	$.getJSON(urlx, function(data) {
				All.set_enable_button();
			    if(data.response == "true") {
			    	var arrayData = data.arrayData;
			    	var rowshtml = "<option value=''>--Pilih disini--</option>";
			    	$.each(arrayData, function(key, value) {
						rowshtml += "<option value="+value.loccd+">"+value.loccd+ " - " + value.fullnm +"</option>";
                    });
                    $(All.get_active_tab() + " " +setTo).html(null);
                    $(All.get_active_tab() + " " +setTo).append(rowshtml);
			    } else {
			    	$(All.get_active_tab() + " " +setTo).html(null);
			    	alert(data.message);
			    }
			});
    },
    
    saveRegMember : function() {
    	All.set_disable_button();
		All.get_wait_message();
		$.post(All.get_url("member/reg/input/save") , $(All.get_active_tab() + "#frm_reg2").serialize(), function(data)
        {  
            All.set_enable_button();
            $(All.get_active_tab() + ".nextForm1").hide();
			All.clear_div_in_boxcontent(".nextForm2");
            $(All.get_active_tab() + ".nextForm2").html(data);  
        }).fail(function() { 
            alert("Error requesting page"); 
            All.set_enable_button();
        }); 
    },
    
    setChooseVoucher : function() {
    	var x = $(All.get_active_tab() + " #chosevoucher").val();
  		   if(x == "0") {
  		   		$(All.get_active_tab() + ".vch").attr("readonly", "readonly");	
  		   } else {
  		   	    $(All.get_active_tab() + ".vch").removeAttr("readonly");
  		   }
    },
    
    backToInput : function() {
    	All.clear_div_in_boxcontent(".nextForm1");
        All.clear_div_in_boxcontent(".nextForm2");
        All.clear_div_in_boxcontent(".nextForm3");
        All.clear_div_in_boxcontent(".nextForm4");
        
        All.set_all_to_display();
        All.reload_page('member/reg');
    }
}