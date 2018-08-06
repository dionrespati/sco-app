var $ = jQuery;

var Stkbarcode = {
    showSendTo: function (nilai, setto) {

        if (nilai == "stock_move") {
            $(All.get_active_tab() + " #pilGenPl").html(null);
            Stkbarcode.showListWH(setto);
            //$(All.get_active_tab() + " #choose_dest").attr("disabled");
        } else if (nilai == "gen_pl") {
            Stkbarcode.check_gen_pl();
            //Stkbarcode.check_gen_pl();
            //$(All.get_active_tab() + " #choose_dest").removeAttr("disabled");
        } else if (nilai == "sales_sc") {
            //$(All.get_active_tab() + " #choose_dest").attr("disabled");
            $(All.get_active_tab() + " #pilGenPl").html(null);
            $(All.get_active_tab() + setto).html(null);
            var rowhtml = "<label class='control-label' for='typeahead'>Send to Stockist</label>";
            rowhtml += "<div class='controls' >";
            rowhtml += "<input type=text id=sendTo name=sendTo placeholder='ID Stockist' onchange=All.getFullNameByID(this.value,'db2/get/fullnm/from/mssc/loccd','#info') />";
            rowhtml += "<input readonly=readonly type=text id=info name=info style='width: 350px' />";
            rowhtml += "</div><div class='clearfix'></div>";
            $(All.get_active_tab() + setto).append(rowhtml);
        } else if (nilai == "bc_track") {
            $(All.get_active_tab() + " #pilGenPl").html(null);
            $(All.get_active_tab() + setto).html(null);
            var rowhtml = "<label class='control-label' for='typeahead'>Barcode</label>";
            rowhtml += "<div class='controls' >";
            rowhtml += "<input type=text id=sendTo name=sendTo placeholder='Kode Barcode' class='span5' />";
            rowhtml += "</div><div class='clearfix'></div>";
            $(All.get_active_tab() + setto).append(rowhtml);
        } else {
            //$(All.get_active_tab() + " #choose_dest").attr("disabled");
            $(All.get_active_tab() + " #pilGenPl").html(null);
            $(All.get_active_tab() + setto).html(null);
            var rowhtml = "<label class='control-label' for='typeahead'>Send to Distributor</label>";
            rowhtml += "<div class='controls' >";
            rowhtml += "<input type=text id=sendTo name=sendTo placeholder='ID Member' onchange=All.getFullNameByID(this.value,'db2/get/fullnm/from/msmemb/dfno','#info') />";
            rowhtml += "<input readonly=readonly type=text id=info name=info style='width: 350px' />";
            rowhtml += "</div><div class='clearfix'></div>";
            $(All.get_active_tab() + setto).append(rowhtml);
        }
    },

    check_gen_pl: function () {
        $(All.get_active_tab() + "#divSendTo").html(null);
        $(All.get_active_tab() + "#pilGenPl").html(null);
        var rowhtml = "<label class='control-label' for='typeahead'>Destination</label>";
        rowhtml += "<div class='controls' >";
        rowhtml += "<select class='span5' id='choose_dest' name='choose_dest' onchange=Stkbarcode.showSendToGPL(this.value,'#divSendTo')>";
        rowhtml += "<option value=''>--Select Here--</option>";
        rowhtml += "<option value='sales_sc'>Stockist</option>";
        rowhtml += "<option value='sales_inv'>Distributor</option>";
        rowhtml += "<option value='stock_move'>Warehouse</option>";
        rowhtml += "</select></div>";
        rowhtml += "<input type='hidden' id=info name=info />";
        rowhtml += "<div class='clearfix'></div>";
        $(All.get_active_tab() + "#pilGenPl").append(rowhtml);
    },

    showSendToGPL: function (nilai, setto) {
        if (nilai == "sales_sc") {
            //$(All.get_active_tab() + " #choose_dest").attr("disabled");
            //$(All.get_active_tab() + " #pilGenPl").html(null);
            $(All.get_active_tab() + setto).html(null);
            var rowhtml = "<label class='control-label' for='typeahead'>Send to Stockist</label>";
            rowhtml += "<div class='controls' >";
            rowhtml += "<input type=text id=sendTo name=sendTo placeholder='ID Stockist' onchange=All.getFullNameByID(this.value,'db2/get/fullnm/from/mssc/loccd','#info') />";
            rowhtml += "<input readonly=readonly type=text id=info name=info style='width: 350px' />";
            rowhtml += "</div><div class='clearfix'></div>";
            $(All.get_active_tab() + setto).append(rowhtml);
        } else if (nilai == "stock_move") {
            //$(All.get_active_tab() + " #pilGenPl").html(null);
            Stkbarcode.showListWH(setto);
            //$(All.get_active_tab() + " #choose_dest").attr("disabled");
        } else {
            // $(All.get_active_tab() + " #pilGenPl").html(null);
            $(All.get_active_tab() + setto).html(null);
            var rowhtml = "<label class='control-label' for='typeahead'>Send to Distributor</label>";
            rowhtml += "<div class='controls' >";
            rowhtml += "<input type=text id=sendTo name=sendTo placeholder='ID Member' onchange=All.getFullNameByID(this.value,'db2/get/fullnm/from/msmemb/dfno','#info') />";
            rowhtml += "<input readonly=readonly type=text id=info name=info style='width: 350px' />";
            rowhtml += "</div><div class='clearfix'></div>";
            $(All.get_active_tab() + setto).append(rowhtml);
        }
    },

    showListWH: function (setto) {
        $.ajax({
            url: All.get_url("stk/barcode/wh/list"),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == 'true') {
                            var arraydata = data.arrayData;
                            $(All.get_active_tab() + setto).html(null);
                            var rowhtml = "<label class='control-label' for='typeahead'>Send to Warehouse</label>";
                            rowhtml += "<div class='controls' >";
                            rowhtml += "<select class='span5' id='sendTo' name='sendTo' onchange='Stkbarcode.setWHinfo()'>";
                            rowhtml += "<option value=''>--Select Here--</option>";
                            $.each(arraydata, function (key, value) {
                                rowhtml += "<option value='" + value.code + "'>" + value.description + "</option>";
                            });

                            rowhtml += "</select></div>";
                            rowhtml += "<input type='hidden' id=info name=info />";
                            rowhtml += "<div class='clearfix'></div>";
                            $(All.get_active_tab() + setto).append(rowhtml);
                            //console.log("isi :" +setto);
                        } else {
                            alert("Data not found..!!");
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    setWHinfo: function () {
        var x = $(All.get_active_tab() + "#sendTo option:selected").text();
        $(All.get_active_tab() + "#info").val(x);
    },

    getListProductBarcode: function (param) {
        //var param = theLink.id;
        var prdcd = $(All.get_active_tab() + "#prdcd" + param).val();
        var prdnm = $(All.get_active_tab() + "#prdnm" + param).val();
        var trcd = $(All.get_active_tab() + "#trcd").val();
        var qty = parseInt($(All.get_active_tab() + "#qty" + param).val());

        $.ajax({
            dataType: 'json',
            url: All.get_url("stk/barcode/process/" + trcd + "/" + prdcd),
            type: 'GET',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == 'true')
                        {

                            $(All.get_active_tab() + ".nextForm1").hide();
                            $(All.get_active_tab() + ".nextForm2").html(null);
                            var arraydata = data.arrayData;
                            var rowshtml = "<form id=saveBarcode><table width='60%' class='table table-striped table-bordered bootstrap-datatable datatable'>";
                            rowshtml += "<thead><tr bgcolor=#f4f4f4>";
                            rowshtml += "<th width=10%>No</th>";
                            rowshtml += "<th width=25%>Trx No</th>";
                            rowshtml += "<th width=35%>Product Code</th>";
                            rowshtml += "<th>Barcode</th>";
                            rowshtml += "</tr></thead><tbody>";
                            $.each(arraydata, function (key, value) {
                                rowshtml += "<tr id=" + (key + 1) + ">";
                                rowshtml += "<td><div align=right>" + (key + 1) + "</div></td>";
                                rowshtml += "<td><div align=center>" + value.trcd + "</div></td>";
                                rowshtml += "<td><div align=center>" + value.prdcd + "</div></td>";
                                rowshtml += "<td><div align=center>" + value.prdcd_bc + "</div></td>";
                                rowshtml += "</tr>";
                            });
                            rowshtml += "</tbody></table>";
                            rowshtml += "<table><tr><td>";
                            rowshtml += "<input class='btn btn-warning' type=button value=Back onclick=All.back_to_form('.nextForm2','.nextForm1') />";
                            rowshtml += "&nbsp;";
                            rowshtml += "<input type=hidden id=trcd name=trcd value=" + trcd + " />";
                            rowshtml += "<input type=hidden id=qtysum name=qtysum value=" + qty + " />";
                            rowshtml += "</td></tr></table>";
                            rowshtml += "</form>";
                            $(All.get_active_tab() + ".nextForm2").append(rowshtml);
                            $(All.get_active_tab() + ".nospacing").css('margin-bottom', '1px');
                        } else
                        {
                            alert("Data not found..!!");
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getListProduct: function (theLink) {
        var param = theLink.id;
        var prdcd = $(All.get_active_tab() + "#prdcd" + param).val();
        var prdnm = $(All.get_active_tab() + "#prdnm" + param).val();
        var trcd = $(All.get_active_tab() + "#trcd").val();
        var qty = parseInt($(All.get_active_tab() + "#qty" + param).val());

        $(All.get_active_tab() + ".nextForm1").hide();
        $(All.get_active_tab() + ".nextForm2").html(null);
        var rowshtml = "<form id=saveBarcode><table width='80%' class='table table-striped table-bordered'>";
        rowshtml += "<thead><tr>";
        rowshtml += "<td width=15%>Trx No</td><td>" + trcd + "</td></tr>";
        rowshtml += "<tr><td>Product Code</td><td>" + prdcd + "</td></tr>";
        rowshtml += "<tr><td>Product Name</td><td>" + prdnm + "</td></tr>";
        rowshtml += "<tr><td>Qty</td><td colspan=2>" + qty + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;<font color=red>Total Qty Scanned : <span id=showQtyScan>0</span></font>&nbsp;)</td></tr>";
        rowshtml += "<tr><td>Barcode Input Type</td>";
        rowshtml += "<td><select id=barcodeType class=nospacing>";
        rowshtml += "<option value=1>Single/Multiple Barcode</option>";
        //rowshtml += "<option value=2>Single Barcode</option>";
        rowshtml += "</select>&nbsp;<input type=button id=addBarType value=Add class='btn btn-primary' onclick=Stkbarcode.addBarcodeInput() />&nbsp;<input id=clearBtn class='btn btn-danger' type=button value=Clear onclick=Stkbarcode.clearbarcode() /></td></tr>";
        //rowshtml += "<table width=80%>";
        rowshtml += "</thead><tbody id=rowBarcode></tbody>";
        rowshtml += "</table>";
        rowshtml += "<table><tr><td>";
        rowshtml += "<input class='btn btn-warning' type=button value=Back onclick=All.back_to_form('.nextForm2','.nextForm1') />";
        rowshtml += "&nbsp;<input id=saveBtn class='btn btn-primary' type=button value=Save onclick=Stkbarcode.savebarcode() />";

        rowshtml += "<input type=hidden id=trcd name=trcd value=" + trcd + " />";
        rowshtml += "<input type=hidden id=prdcd name=prdcd value=" + prdcd + " />";
        rowshtml += "<input type=hidden id=qtysum name=qtysum value=" + qty + " />";
        rowshtml += "<input type=hidden id=multiSum name=multiSum value=0 />";
        //rowshtml += "<input type=hidden id=singleSum name=singleSum value=0 />";
        rowshtml += "<div id=realInput></div>";
        rowshtml += "</td></tr></table>";
        rowshtml += "</form>";
        $(All.get_active_tab() + ".nextForm2").append(rowshtml);
        $(All.get_active_tab() + ".nospacing").css('margin-bottom', '1px');
    },

    addBarcodeInput: function () {
        var rowshtml = "";
        var tipe = $(All.get_active_tab() + "#barcodeType").val();
        var multiSum = parseInt($(All.get_active_tab() + "#multiSum").val());
        //var singleSum =  parseInt($(All.get_active_tab() + "#singleSum").val());
        //console.log("tipe :" +tipe);
        //if(tipe == 1) {
        var jum = parseInt($(All.get_active_tab() + "#showQtyScan").text());
        var qty = parseInt($(All.get_active_tab() + "#qtysum").val());
        if (jum < qty) {
            //alert("jum : " +jum+ " qty : " +qty);
            var mul = multiSum + 1;
            rowshtml += "<tr id=parame" + mul + ">";
            rowshtml += "<td>Barcode :&nbsp;</td>";
            //onkeypress='return setNext(event, this)'
            rowshtml += "<td><input type=text id=multi" + mul + " name=multi[] style='width: 250px;' onkeypress='return Stkbarcode.countMultiScan(this.value, event, " + mul + ")' />";
            //rowshtml += "<td>&nbsp;</td>";
            rowshtml += "&nbsp;&nbsp;&nbsp;Qty Scanned :<input readonly=readonly type=text id=countScanMultiple" + mul + " style='width: 30;' />";
            rowshtml += "&nbsp;<input class='btn btn-danger' type='button' value='Delete' onclick='Stkbarcode.deleteBarcode(" + mul + ")'>";
            rowshtml += "</td></tr>";
            $(All.get_active_tab() + "#rowBarcode").append(rowshtml);
            $(All.get_active_tab() + ".nospacing").css('margin-bottom', '1px');
            $(All.get_active_tab() + "#multiSum").val(mul);
            $(All.get_active_tab() + "#multi" + multiSum).attr('readonly', 'readonly');
            $(All.get_active_tab() + "#multi" + mul).focus();
        } else {
            alert("Maximum barcode scan reached..!! Check Qty Product..!!");
            $(All.get_active_tab() + "#multi" + multiSum).attr('readonly', 'readonly');
        }

    },

    deleteBarcode: function (param) {
        var x = $(All.get_active_tab() + "#multi" + param).val();
        var showQtyScan = parseInt($(All.get_active_tab() + "#showQtyScan").text());
        var res = x.split('|');
        var jumQty = res.length;
        var xx = 0;
        for (i = 0; i < res.length; i++) {
            $("input[class=forInput][type=hidden][value='" + res[i] + "']").remove();
            xx++;
        }
        var selisih = showQtyScan - xx;
        //$(All.get_active_tab() + "#qtysum").val(selisih);
        $(All.get_active_tab() + "#showQtyScan").html(selisih);
        $("tr#parame" + param).remove();
    },

    clearbarcode: function () {
        $(All.get_active_tab() + "#rowBarcode").html(null);
        $(All.get_active_tab() + "#multiSum").val(0);
        $(All.get_active_tab() + "#showQtyScan").text(0);
        $(All.get_active_tab() + "#realInput").html(null);
        //$(All.get_active_tab() + "#singleSum").val(0);
    },

    countMultiScan: function (h, evt, param) {
        //console.log("isi h :" +h);
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
        if (charCode == 13 || charCode == 3 || charCode == 9)
        {
            evt.preventDefault();
            if (h == "" || h == " ")
            {
                alert("Barcode harus diisi..!!");
            } else {
                var res = h.split('|');

                var jum = parseInt($(All.get_active_tab() + "#showQtyScan").text());
                var afterjum = jum + res.length;
                var qty = parseInt($(All.get_active_tab() + "#qtysum").val());
                if (afterjum <= qty) {

                    var timeRepeated = 0;
                    for (i = 0; i < res.length; i++) {
                        $(".forInput").each(function () {
                            if (this.value == res[i]) {
                                timeRepeated++; //this will be executed at least 1 time because of the input, which is changed just now
                            }
                        });
                        if (timeRepeated <= 0)
                        {
                            rowshtml = "<input class=forInput type=hidden name=barcode[] value='" + res[i] + "' />";
                            $(All.get_active_tab() + "#realInput").append(rowshtml);
                        } else {
                            alert("Ada isi barcode yg sama..!!");
                        }
                    }
                    //alert("Isi qty :" +res.length);
                    if (timeRepeated <= 0) {
                        $(All.get_active_tab() + "#countScanMultiple" + param).val(res.length);
                        Stkbarcode.setTotScannedQty(res.length);
                        Stkbarcode.addBarcodeInput();
                        return false;
                    }
                } else {
                    alert("Jumlah barcode lebih dari :" + qty);

                }

            }
        }
        return true;
    },

    setTotScannedQty: function (jumlah) {
        var jum = parseInt($(All.get_active_tab() + "#showQtyScan").text());
        var x = jum + jumlah;
        $(All.get_active_tab() + "#showQtyScan").text(x);
    },

    setNextTo: function (e) {
        if (e.keyCode == 13 || e.keyCode == 9) {
            var x = parseInt(document.activeElement.tabIndex);
            var next = x + 1;

            var nilai = $(All.get_active_tab() + "#barcode" + x).val();
            var timeRepeated = 0;
            $("input[type='text']").each(function () {
                //Inside each() check the 'valueOfChangedInput' with all other existing input
                if ($(this).val() == nilai) {
                    timeRepeated++; //this will be executed at least 1 time because of the input, which is changed just now
                }
            });

            if (timeRepeated > 1) {
                alert("Nilai barcode sudah ada, barcode tidak boleh sama..!!");
                $(All.get_active_tab() + "#barcode" + x).val(null);
                All.set_disable_button();
            } else {
                $(All.get_active_tab() + "#barcode" + next).focus();
                All.set_enable_button();
            }
        }
    },

    savebarcode: function () {
        All.set_disable_button();
        var kosong = 0;
        var qtysum = parseInt($(All.get_active_tab() + "#qtysum").val());
        var trcd = $(All.get_active_tab() + "#trcd").val();
        if (qtysum >= 1) {
            $(All.get_active_tab() + ".forInput").each(function () {
                if (this.value == "") {
                    kosong++;
                }
            });
            var isix = parseInt(kosong);
            var xx = isix - 1;
            if (kosong === 0) {
                //All.set_enable_button();
                $.post(All.get_url('stk/barcode/save'), $(All.get_active_tab() + "#saveBarcode").serialize(), function (data)
                {
                    All.set_enable_button();
                    if (data.response == 'true') {
                        alert(data.message);
                        $(All.get_active_tab() + ".nextForm2").html(null);
                        //$(All.get_active_tab() + ".nextForm1").html(null);
                        $(All.get_active_tab() + ".nextForm1").show();
                        //Stkbarcode.getDetailProdByTTPVersi2(data.trcd);
                        All.ajaxShowDetailonNextForm('stk/barcode/trx/id/' + trcd);
                    } else {
                        alert(data.message);
                    }
                }, "json").fail(function () {
                    alert("Error requesting page");
                    All.set_enable_button();
                });
                //alert('trcd :' +trcd);

            } else {

                alert("Masih ada inputan barcode yang kosong..!!!, kosong : " + kosong);
                All.set_enable_button();

            }
        } else {
            alert("OK ");
            All.set_enable_button();

        }
    },

    scanToBarcodePrdStk: function (selisih, prdcd, stk, qtyOrd, dono, prdnm) {
        //stk/barcode/save
        /*console.log(prdcd);
         console.log(selisih);
         console.log(stk);
         console.log(qtyOrd);*/

        // alert("Isi : "+prdcd+ " prdnm :" +prdnm+ "trdcdGroup :" +trcdGroup);      
        $(All.get_active_tab() + ".nextForm1").hide();
        $(All.get_active_tab() + ".nextForm2").html(null);
        var rowshtml = "<form id=saveBarcodeWhtoStk><table width='80%' class='table table-striped table-bordered'>";
        rowshtml += "<thead><tr>";
        rowshtml += "<td width=15%>DO No</td><td>" + dono + "</td></tr>";
        rowshtml += "<tr><td>Product Code</td><td>" + prdcd + "</td></tr>";
        rowshtml += "<tr><td>Product Name</td><td>" + prdnm + "</td></tr>";
        rowshtml += "<tr><td>Qty</td><td colspan=2>" + selisih + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;<font color=red>Total Qty Scanned : <span id=showQtyScan>0</span></font>&nbsp;)</td></tr>";
        rowshtml += "<tr><td>Barcode Input Type</td>";
        rowshtml += "<td><select id=barcodeType class=nospacing>";
        rowshtml += "<option value=1>Single/Multiple Barcode</option>";
        //rowshtml += "<option value=2>Single Barcode</option>";
        rowshtml += "</select>&nbsp;<input type=button id=addBarType value=Add class='btn btn-small btn-primary' onclick=Stkbarcode.addBarcodeInput() />&nbsp;<input id=clearBtn class='btn btn-small btn-danger' type=button value=Clear onclick=Stkbarcode.clearbarcode() /></td></tr>";
        //rowshtml += "<table width=80%>";
        rowshtml += "</thead><tbody id=rowBarcode></tbody>";
        rowshtml += "</table>";
        rowshtml += "<table><tr><td>";
        rowshtml += "<input class='btn btn-warning' type=button value=Back onclick=All.back_to_form('.nextForm2','.nextForm1') />";
        rowshtml += "&nbsp;<input id=saveBtn class='btn btn-primary' type=button value=Save onclick=Stkbarcode.saveBarcodeWHtoStk() />";

        rowshtml += "<input type=hidden id=trcd name=trcd value='" + dono + "' />";
        rowshtml += "<input type=hidden id=sendTo name=sendTo value='" + stk + "' />";
        //rowshtml += "<input type=hidden id=info name=info value='"+info+"' />";
        rowshtml += "<input type=hidden id=prdcd name=prdcd value='" + prdcd + "' />";
        rowshtml += "<input type=hidden id=qtysum name=qtysum value=" + selisih + " />";
        rowshtml += "<input type=hidden id=qtyord name=qtyord value=" + qtyOrd + " />";
        rowshtml += "<input type=hidden id=multiSum name=multiSum value=0 />";
        //rowshtml += "<input type=hidden id=singleSum name=singleSum value=0 />";
        rowshtml += "<div id=realInput></div>";
        rowshtml += "</td></tr></table>";
        rowshtml += "</form>";
        $(All.get_active_tab() + ".nextForm2").append(rowshtml);
        $(All.get_active_tab() + ".nospacing").css('margin-bottom', '1px');
    },

    saveBarcodeWHtoStk: function () {
        All.set_disable_button();
        var kosong = 0;
        var qtysum = parseInt($(All.get_active_tab() + "#qtyord").val());
        var trcd = $(All.get_active_tab() + "#trcd").val();
        if (qtysum >= 1) {
            $(All.get_active_tab() + ".forInput").each(function () {
                if (this.value == "") {
                    kosong++;
                }
            });
            var isix = parseInt(kosong);
            var xx = isix - 1;
            if (kosong === 0) {
                All.set_enable_button();
                $.post(All.get_url('stk/barcode/save'), $(All.get_active_tab() + "#saveBarcodeWhtoStk").serialize(), function (data)
                {
                    All.set_enable_button();
                    if (data.response == 'true') {
                        alert(data.message);
                        $(All.get_active_tab() + ".nextForm2").html(null);
                        //$(All.get_active_tab() + ".nextForm1").html(null);
                        $(All.get_active_tab() + ".nextForm1").show();
                        //Stkbarcode.getDetailProdByTTPVersi2(data.trcd);
                        All.ajaxShowDetailonNextForm('stk/barcode/trx/id/' + trcd);
                    } else {
                        alert(data.message);
                    }
                }, "json").fail(function () {
                    alert("Error requesting page");
                    All.set_enable_button();
                });
            } else {

                alert("Masih ada inputan barcode yang kosong..!!!, kosong : " + kosong);
                All.set_enable_button();

            }
        } else {
            alert("OK ");
            All.set_enable_button();

        }
    },

    generatePackingList: function () {
        All.set_disable_button();
        //All.get_image_load("result");
        $.post(All.get_url('stk/barcode/generate/pl'), $("#frmPrepPL").serialize(), function (data)
        {
            All.set_enable_button();
            if (data.response == 'true') {
                //Stkbarcode.listProdSummary(data.shipinfo.trcdGroup, '.nextForm2');
            } else {
                //All.set_error_message("result");
            }
        }, "json").fail(function () {
            alert("Error requesting page");
            $(".result").html(null);
            All.set_enable_button();
        });
    },
}
