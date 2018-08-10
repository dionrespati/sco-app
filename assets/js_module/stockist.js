var $ = jQuery;

var Stockist = {
    getStockistInfo: function (nilai) {
        All.set_disable_button();
        $.ajax({
            url: All.get_url("stockist/id/" + nilai),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            $(All.get_active_tab() + " #fullnm").val(data.arrayData[0].fullnm);
                            $(All.get_active_tab() + " #addr1").val(data.arrayData[0].addr1);
                            $(All.get_active_tab() + " #addr2").val(data.arrayData[0].addr2);
                            $(All.get_active_tab() + " #addr3").val(data.arrayData[0].addr3);
                            $(All.get_active_tab() + " #tel_hp").val(data.arrayData[0].tel_hp);
                            $(All.get_active_tab() + " #tel_of").val(data.arrayData[0].tel_of);
                            $(All.get_active_tab() + " #tel_hm").val(data.arrayData[0].tel_hm);
                            $(All.get_active_tab() + " #lastkitno").val(data.arrayData[0].lastkitno);
                            $(All.get_active_tab() + " #arkit").val(data.arrayData[0].arkit);
                            $(All.get_active_tab() + " #limitkit").val(data.arrayData[0].limitkit);
                            $(All.get_active_tab() + " #sisa_kuota").val(data.arrayData[0].sisa_kuota);
                        } else {
                            alert(data.message);
                            All.reset_all_input();
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getStkScType: function (param) {
        var kodestk = $(param).val();
        console.log("pram : " + param.id);
        All.set_disable_button();
        $.ajax({
            url: All.get_url("sales/stk/info/" + kodestk),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            if (param.id == "sc_dfno") {
                                var sctype = parseInt(data.arrayData[0].sctype);
                                var co_sctype = parseInt($(All.get_active_tab() + " #co_sctype").val());
                                //console.log("co_sctype : " +co_sctype);
                                //console.log("sctype : " +sctype);
                                if (co_sctype > sctype) {
                                    alert("C/O Stockist tidak boleh lebih rendah dari Stockist..");
                                    $(All.get_active_tab() + " #sc_name").val(null);
                                    $(All.get_active_tab() + " #sctype").val(null);
                                } else {

                                    $(All.get_active_tab() + " #sc_name").val(data.arrayData[0].fullnm);
                                    $(All.get_active_tab() + " #sctype").val(data.arrayData[0].sctype);
                                }


                            } else if (param.id == "sc_co") {

                                var co_sctype = parseInt(data.arrayData[0].sctype);
                                var sctype = parseInt($(All.get_active_tab() + " #sctype").val());
                                //console.log("co_sctype : " +co_sctype);
                                //console.log("sctype : " +sctype);
                                if (co_sctype > sctype) {
                                    alert("C/O Stockist tidak boleh lebih rendah dari Stockist..");
                                    $(All.get_active_tab() + " #sc_co_name").val(null);
                                    $(All.get_active_tab() + " #co_sctype").val(null);
                                } else {
                                    $(All.get_active_tab() + " #sc_co_name").val(data.arrayData[0].fullnm);
                                    $(All.get_active_tab() + " #co_sctype").val(data.arrayData[0].sctype);
                                }

                            }

                        } else {
                            alert(data.message);
                            //All.reset_all_input();
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getProductPrice: function (param) {
        var prdcd = $(All.get_active_tab() + " #prdcd" + param).val();
        var pricecode = $(All.get_active_tab() + " #pricecode").val();
        var prd_voucher = $(All.get_active_tab() + " #prd_voucher").val();
        All.set_disable_button();
        $.ajax({
            url: All.get_url("product/id/" + prdcd + "/" + pricecode),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            $(All.get_active_tab() + " #prdcd" + param).val(data.arrayData[0].prdcd);
                            $(All.get_active_tab() + " #prdnm" + param).val(data.arrayData[0].prdnm);
                            if (prd_voucher == "1") {
                                $(All.get_active_tab() + " #poin" + param).val(0);
                                $(All.get_active_tab() + " #sub_tot_bv" + param).val(0);
                            } else {
                                $(All.get_active_tab() + " #poin" + param).val(All.num(parseInt(data.arrayData[0].bv)));
                                $(All.get_active_tab() + " #sub_tot_bv" + param).val(All.num(parseInt(data.arrayData[0].bv)));
                            }

                            $(All.get_active_tab() + " #harga" + param).val(All.num(parseInt(data.arrayData[0].dp)));

                            $(All.get_active_tab() + " #sub_tot_dp" + param).val(All.num(parseInt(data.arrayData[0].dp)));
                            Stockist.calculateAllPrice();
                        } else {
                            alert(data.message);
                            $(All.get_active_tab() + " #prdcd" + param).val("");
                            $(All.get_active_tab() + " #prdnm" + param).val("");
                            $(All.get_active_tab() + " #jum" + param).val("");
                            $(All.get_active_tab() + " #poin" + param).val(0);
                            $(All.get_active_tab() + " #harga" + param).val(0);
                            $(All.get_active_tab() + " #sub_tot_bv" + param).val(0);
                            $(All.get_active_tab() + " #sub_tot_dp" + param).val(0);
                            Stockist.calculateAllPrice();
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    calculateProduct: function (param) {
        var qty = $(All.get_active_tab() + " #jum" + param).val();
        var nm = /^[0-9]+$/;
        if (qty == '0' || qty == '' || !qty.match(nm)) {
            $(All.get_active_tab() + " #jum" + param).val(1);
            $(All.get_active_tab() + " #jum" + param).select();
            Stockist.calculateAllPrice();
            Stockist.hitungTotalBayar();
            //console.log("MASUK SINI");
        } else {
            Stockist.calculateAllPrice();
            Stockist.hitungTotalBayar();
        }
    },

    nextFocus: function () {
        $(All.get_active_tab() + " #addRow").focus();
    },

    calculateAllPrice: function () {
        var rec = parseInt($(All.get_active_tab() + " #rec").val());
        var total_dp = 0;
        var total_bv = 0;
        /*$(All.get_active_tab() + ' input[name^="jum"]').each(function() {
         
         var dp = $(this).parents('td').find('input[name^="harga"]').val();
         var bv = $(this).parents('td').find('input[name^="poin"]').val();
         console.log("dp : " +dp);
         //total_dp += parseInt($(this).val()) * parseInt(All.num_normal(dp));
         //total_bv += parseInt($(this).val()) * parseInt(All.num_normal(bv));
         });*/
        //console.log("Tot DP : " +total_dp+ " Tot BV : " +total_bv);
        var count_rec = 0;
        for (var i = 1; i <= rec; i++) {
            var prdcd = $(All.get_active_tab() + " #prdcd" + i).val();
            if (typeof (prdcd) !== "undefined") {
                //console.log("prdcd : " +prdcd);
                var jum = parseInt($(All.get_active_tab() + " #jum" + i).val());
                if (jum == "") {
                    jum = 1;
                    //$(All.get_active_tab() + " #jum" +i).val(1)
                }
                var poin = parseInt(All.num_normal($(All.get_active_tab() + " #poin" + i).val()));
                var harga = parseInt(All.num_normal($(All.get_active_tab() + " #harga" + i).val()));

                var sub_harga = jum * harga;
                var sub_poin = jum * poin;
                //console.log("sub_harga : " +sub_harga);
                total_bv += sub_poin;
                total_dp += sub_harga;

                $(All.get_active_tab() + " #sub_tot_bv" + i).val(All.num(sub_poin));
                $(All.get_active_tab() + " #sub_tot_dp" + i).val(All.num(sub_harga));

                $(All.get_active_tab() + " #total_all_bv").val(All.num(total_bv));
                $(All.get_active_tab() + " #total_all_dp").val(All.num(total_dp));
                $(All.get_active_tab() + " #total_all_bv_real").val(total_bv);
                $(All.get_active_tab() + " #total_all_dp_real").val(total_dp);
                $(All.get_active_tab() + " #payValue").val(All.num(total_dp));
                $(All.get_active_tab() + " #total_cost").val(All.num(total_dp));
                //$(All.get_active_tab() + " #payValue_real").val(total_dp);

                //totQtyWest += parseInt($("#qty" +i).val());
                //totQtyEast += parseInt($("#qty" +i).val());
            } else {
                count_rec++
            }
        }

        if (count_rec == rec) {
            $(All.get_active_tab() + " #total_all_bv").val(All.num(0));
            $(All.get_active_tab() + " #total_all_dp").val(All.num(0));
            $(All.get_active_tab() + " #total_cost").val(All.num(0));
        }
    },

    addNewRecordPrd: function () {
        var amount = parseInt($(All.get_active_tab() + " #rec").val());
        var tabidx = parseInt($(All.get_active_tab() + " #tabidx").val());
        var j = tabidx + 1;
        var z = amount + 1;
        console.log("add idx : " + j);

        var rowhtml = "<tr>";
        rowhtml += "<td><input onchange=Stockist.getProductPrice(" + z + ") tabindex=" + j + " type='text' class='span12 typeahead' id=prdcd" + z + "  name=prdcd[] value=''/></td>";
        rowhtml += "<td><input readonly=readonly type='text' class='span12 typeahead' id=prdnm" + z + "  name=prdnm[] value=''/></td>";
        j++;
        rowhtml += "<td><input onkeyup=Stockist.calculateProduct(" + z + ") tabindex=" + j + " style='text-align:right;' type='text' class='span12 typeahead jumlah' id=jum" + z + "  name=jum[] value='' /></td>";
        rowhtml += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead jumlah' id=poin" + z + "  name=poin[] value='' /></td>";
        rowhtml += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead jumlah' id=harga" + z + "  name=harga[] value='' /></td>";
        rowhtml += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead' id=sub_tot_bv" + z + "  name=sub_tot_bv[] value='' /></td>";
        rowhtml += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead' id=sub_tot_dp" + z + "  name=sub_tot_dp[] value='' /></td>";
        rowhtml += "<td align=center><a onclick=javascript:Stockist.delPayment(this) class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
        rowhtml += "</tr>";
        var y = j + 1;
        //console.log("next tab idx : " +y);
        var new_rec = amount + 1;
        $(All.get_active_tab() + " #addPrd").append(rowhtml);
        $(All.get_active_tab() + " #addRow").removeAttr("tabindex");
        $(All.get_active_tab() + " #addRow").attr("tabindex", y);
        $(All.get_active_tab() + " #rec").val(new_rec);
        $(All.get_active_tab() + " #tabidx").val(j);
        $("#prdcd" + z).focus();
    },

    addPayment: function () {
        var paytype = $(All.get_active_tab() + " #paytype").val();
        var paytypeTxt = $(All.get_active_tab() + " #paytype option:selected").text();
        var total_all_dp = parseInt(All.num_normal($(All.get_active_tab() + " #total_all_dp").val()));
        var pay = parseInt(All.num_normal($(All.get_active_tab() + " #pay").val()));
        var prd_voucher = $(All.get_active_tab() + " #prd_voucher").val();
        if (paytype == "01") {
            var repeat = 0;
            var vchno = $(All.get_active_tab() + " #payValue").val();
            $(All.get_active_tab() + ".checkReff").each(function () {
                if (this.value == 'CASH') {
                    repeat++;
                }
            });
            if (repeat > 0) {
                alert("Pembayaran Cash tidak dapat digunakan dua kali..")
            } else {

                $(All.get_active_tab() + " #jenis_bayar").val("id");
                var payValue = parseInt(All.num_normal($(All.get_active_tab() + " #payValue").val()));
                pay = pay + payValue;
                var rowhtml = "<tr>";
                rowhtml += "<td align=center>" + paytypeTxt + "<input type=hidden name=payChooseType[] value=" + paytype + " /></td>";
                rowhtml += "<td align=center>&nbsp;<input class='checkReff' type=hidden name=payReff[] value='CASH' /></td>";
                rowhtml += "<td align=right><input onchange=Stockist.hitungTotalBayar() class='forSum' style='text-align:right; width:160px;' type=text name=payChooseValue[] value=" + All.num(payValue) + " /></td>";
                rowhtml += "<td align=center><a onclick=javascript:Stockist.delPayment(this) class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
                rowhtml += "</tr>";
                $(All.get_active_tab() + " #payChoose").append(rowhtml);

                Stockist.hitungTotalBayar();
            }
        } else {


            var repeat = 0;
            var idmember = $(All.get_active_tab() + " #dfno").val();
            var vchno = $(All.get_active_tab() + " #payValue").val();
            //var payValue = $(All.get_active_tab() + " #payValue").val();
            if (idmember == "") {
                alert("ID Member harus diisi..");
            } else {
                $(All.get_active_tab() + ".checkReff").each(function () {
                    if (this.value == vchno) {
                        repeat++;
                    }
                });

                if (repeat > 0) {
                    alert("Voucher yang sama tidak dapat digunakan dua kali..")
                } else {
                    if (paytype == "10") {

                        $(All.get_active_tab() + " #jenis_bayar").val("pv");
                        $(All.get_active_tab() + " #prd_voucher").val(1);
                    } else {
                        $(All.get_active_tab() + " #jenis_bayar").val("cv");
                        $(All.get_active_tab() + " #prd_voucher").val(0);
                    }

                    All.set_disable_button();
                    $.ajax({
                        url: All.get_url("sales/vc/check/" + idmember + "/" + vchno + "/" + paytype),
                        type: 'GET',
                        dataType: 'json',
                        success:
                                function (data) {
                                    All.set_enable_button();
                                    if (data.response == "true") {
                                        //Tambah data produk bila tipe voucher adalah XPP / XPV / ZVO
                                        var detProd = data.detProd;
                                        if (detProd != null) {
                                            $(All.get_active_tab() + " #addPrd").html(null);
                                            var rowPrd = "";
                                            $.each(detProd, function (key, value) {
                                                rowPrd += "<tr>";
                                                rowPrd += "<td><input readonly=readonly  type='text' class='span12 typeahead' name=prdcd[] value='" + value.prdcd + "'/></td>";
                                                rowPrd += "<td><input readonly=readonly type='text' class='span12 typeahead' name=prdnm[] value='" + value.prdnm + "'/></td>";
                                                rowPrd += "<td><input readonly=readonly style='text-align:right;' type='text' class='span12 typeahead jumlah' name=jum[] value='" + value.qtyord + "' /></td>";
                                                rowPrd += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead jumlah' name=poin[] value='" + All.num(value.bv) + "' /></td>";
                                                rowPrd += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead jumlah' name=harga[] value='" + All.num(value.dp) + "' /></td>";
                                                rowPrd += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead'  name=sub_tot_bv[] value='" + All.num(parseInt(value.qtyord * value.bv)) + "' /></td>";
                                                rowPrd += "<td><input readonly=readonly style='text-align:right' type='text' class='span12 typeahead' name=sub_tot_dp[] value='" + All.num(parseInt(value.qtyord * value.dp)) + "' /></td>";
                                                rowPrd += "<td align=center><a class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
                                                rowPrd += "</tr>";
                                            });
                                            $(All.get_active_tab() + " #addPrd").append(rowPrd);
                                        }

                                        pay = pay + payValue;
                                        var rowhtml = "<tr>";
                                        rowhtml += "<td align=center>" + paytypeTxt + "<input type=hidden name=payChooseType[] value=" + paytype + " /></td>";
                                        rowhtml += "<td align=center>" + data.arrayData[0].VoucherNo + "<input class='checkReff' type=hidden name=payReff[] value=" + data.arrayData[0].VoucherNo + " /></td>";
                                        rowhtml += "<td align=right>";
                                        rowhtml += "<input class='forSum' readonly=readonly style='text-align:right; width:160px;' type=text name=payChooseValue[] value=" + All.num(parseInt(data.arrayData[0].VoucherAmt)) + " /></td>";
                                        rowhtml += "<td align=center><a onclick=javascript:Stockist.delPayment(this) class='btn btn-mini btn-danger'><i class='icon-trash icon-white'></i></a></td>";
                                        rowhtml += "</tr>";
                                        $(All.get_active_tab() + " #payChoose").append(rowhtml);

                                        Stockist.hitungTotalBayar();
                                    } else {
                                        alert(data.message);
                                    }
                                },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError + ':' + xhr.status);
                            All.set_enable_button();
                        }
                    });
                }
            }
        }
    },

    hitungTotalBayar: function () {
        var vchno = $(All.get_active_tab() + " #payValue").val();
        var total_bayar = 0;
        //var repeat = 0;
        var total_all_dp = parseInt(All.num_normal($(All.get_active_tab() + " #total_all_dp").val()));
        $(All.get_active_tab() + ".forSum").each(function () {

            total_bayar += parseInt(All.num_normal(this.value));
            this.value = All.num(this.value);
        });
        //console.log("Total bayar : " +total_bayar);
        // console.log("Total Cost : " +total_all_dp);
        $(All.get_active_tab() + " #pay").val(All.num(total_bayar));
        var payValue = total_all_dp - total_bayar;
        if (payValue > 0) {
            var sx = All.num(payValue);
            $(All.get_active_tab() + " #change").val("(-) " + sx);
        } else {
            $(All.get_active_tab() + " #change").val(All.num(payValue));
        }

        //return total_bayar;
    },

    delPayment: function (idx) {
        $(idx).closest('tr').remove();
        Stockist.calculateAllPrice();
        Stockist.hitungTotalBayar();
        //$(All.get_active_tab() + " #jenis_bayar").val("cv");
    },

    checkVoucherCash: function (idmember, vchno) {

    },

    saveTrxStockist: function (url, formid) {
        All.set_disable_button();
        All.get_wait_message();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formid).serialize(), function (data)
        {
            All.set_enable_button();
            if (data.response == "true") {
                $(All.get_active_tab() + ".nextForm1").hide();
                All.clear_div_in_boxcontent(".nextForm2");

                var res = data.data;
                var urlx = "";
                var rowhtml = "<table class='table table-striped table-bordered' width='70%' id='resSales'>";
                rowhtml += "<thead>";
                rowhtml += "<th colspan=2>Member Sales Transaction</th>";
                rowhtml += "</tr>";
                rowhtml += "</thead><tbody >";

                rowhtml += "<tr>";
                rowhtml += "<td width=25%>No Trx</td>";
                rowhtml += "<td>&nbsp;" + res.trcd + "</td>";
                rowhtml += "</tr>";
                rowhtml += "<tr>";
                rowhtml += "<td>No TTP</td>";
                rowhtml += "<td>&nbsp;" + res.orderno + "</td>";
                rowhtml += "</tr>";
                rowhtml += "<tr>";
                rowhtml += "<td>ID Member</td>";
                rowhtml += "<td>&nbsp;" + res.dfno + " - " + res.fullnm + "</td>";
                rowhtml += "</tr>";
                rowhtml += "<tr>";
                rowhtml += "<td>Total DP</td>";
                rowhtml += "<td>&nbsp;" + All.num(res.totalDP) + "</td>";
                rowhtml += "</tr>";
                rowhtml += "<tr>";
                rowhtml += "<td>Total BV</td>";
                rowhtml += "<td>&nbsp;" + All.num(res.totalBV) + "</td>";
                rowhtml += "</tr>";
                if (res.pref_trcd == "PV") {
                    urlx = "sales/pvr/input/form";
                } else {
                    urlx = "sales/sub/input/form";
                }
                rowhtml += "<tr>";
                rowhtml += "<td colspan=2><input type=button class='btn btn-warning' value='Input New Sales' onclick=Stockist.newFormSales('" + urlx + "') /></td>";
                rowhtml += "</tr>";
                rowhtml += "</tbody></table>";
                $(All.get_active_tab() + " .nextForm2").html(rowhtml);

            } else {
                alert(data.message);
            }

        }, "json").fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    newFormSales: function (url) {
        All.clear_div_in_boxcontent(".nextForm2");
        $(All.get_active_tab() + ".nextForm1").show();
        All.ajaxShowDetailonNextForm(url);

    }

}

