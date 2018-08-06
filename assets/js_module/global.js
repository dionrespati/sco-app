var $ = jQuery;

var All = {
    get_base: function () {
        var url = config.url;
        return url;
    },

    get_url: function (urlx) {
        var url = All.get_base() + urlx;
        return url;
    },

    get_active_tab: function () {
        var active_div = $("#active_div").val();
        var x = "#tabs-" + active_div + " ";
        return x;
    },

    get_image_load: function (set_to) {
        set_to = set_to || ".mainForm .result";
        $(All.get_box_content() + set_to).html("<center><img src=" + All.get_base() + "/assets/images/ajax-loader.gif ></center>");
    },

    get_image_load2: function () {
        //set_to = set_to || ".mainForm > .result";
        $(All.get_active_tab() + ".result").html("<center><img src=" + All.get_base() + "/assets/images/ajax-loader.gif ></center>");
    },

    set_wait_message: function () {
        var ht = "";
        ht += "<div class=wait_msg style='display: none;' align=center><font color=red>Please wait a moment...</font></div>";
        ht += "<div class=img_load></div>";
        return ht;
    },

    clear_wait_message: function () {
        $(All.get_active_tab() + ".wait_msg").css('display', 'none');
        $(All.get_active_tab() + ".img_load").html(null);
    },

    set_amount_record: function (count) {
        var ht = "";
        ht += "<input type=hidden id=cnt_rec value=" + count + " />";
        ht += "<input type=hidden id=rack_cnt value=" + count + " />";
        return ht;
    },

    get_wait_message: function () {
        $(All.get_active_tab() + ".wait_msg").css('display', 'block');
        //All.get_image_load(All.get_active_tab() + " .img_load");
        $(All.get_active_tab() + ".img_load").html("<center><img src=" + All.get_base() + "/assets/images/ajax-loader.gif ></center>");
    },

    clear_wait_message: function () {
        $(All.get_active_tab() + ".wait_msg").css('display', 'none');
        $(All.get_active_tab() + ".img_load").html(null);
    },

    set_datatable: function () {
        $(All.get_active_tab() + ".datatable").dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            "sPaginationType": "bootstrap",
            "oLanguage": {

            },
            "bDestroy": true
        });
        $(All.get_active_tab() + ".datatable").removeAttr('style');
    },

    set_disable_button: function () {
        $(All.get_active_tab() + ".btn").attr('disabled', 'disabled');

    },

    set_enable_button: function () {
        $(All.get_active_tab() + ".btn").removeAttr('disabled');

    },

    reset_all_input: function () {
        $(All.get_active_tab() + "input[type=file]").val(null);
        $(All.get_active_tab() + "input[type=text]").val(null);
        $(All.get_active_tab() + "input[type=password]").val(null);
        $(All.get_active_tab() + "textarea").val(null);
        $(All.get_active_tab() + "select").val("");
    },

    reset_all_input2: function () {
        $(All.get_active_tab() + "input[type=file]").val(null);
        $(All.get_active_tab() + "input[type=text]").val(null);
        $(All.get_active_tab() + "input[type=hidden]").val(null);
        $(All.get_active_tab() + "input[type=password]").val(null);
        $(All.get_active_tab() + "textarea").val(null);
        $(All.get_active_tab() + "select").val("");
    },

    formUpdateActivate: function () {
        $(All.get_active_tab() + "#inp_btn").css('display', 'none');
        $(All.get_active_tab() + "#upd_btn").css('display', 'block');
        $(All.get_active_tab() + ".setReadOnly").attr('readonly', 'readonly');
    },

    reload_page: function (urlx) {
        var x = All.get_active_tab();
        $.ajax({
            url: All.get_url(urlx),
            type: 'GET',
            success:
                    function (data) {
                        $(All.get_active_tab()).html(null);
                        //$(All.get_active_tab()).html("<center><img src="+ All.get_base() +"/assets/images/ajax-loader.gif ></center>");
                        $(All.get_active_tab()).html(data);
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
        //alert(urlx);
    },

    back_to_form: function (clear_div, show_div) {
        $(All.get_active_tab() + clear_div).html(null);
        $(All.get_active_tab() + show_div).show();
    },

    back_to_form2: function (clear_div, show_div, set_header) {
        $(All.get_box_content() + clear_div).html(null);
        $(All.get_box_content() + show_div).show();
        $(All.get_header_form()).html(set_header);
    },

    get_header_form: function () {
        var getDiv = All.get_active_tab() + "> .row-fluid > .block > .block-heading";
        return getDiv;
    },

    get_box_content: function () {
        var getDiv = All.get_active_tab() + "> .row-fluid > .block > .block-body > .box-content > ";
        return getDiv;
    },

    clear_div_in_boxcontent: function (set_clear) {
        $(All.get_box_content() + set_clear).html(null);
    },

    set_error_message: function (set_to, param) {
        set_to = set_to || "hasil";
        param = param || "No result found";

        $(All.get_box_content() + set_to).html(null);
        $(All.get_box_content() + set_to).html("<div class='alert alert-error' align=center>" + param + "</div>");
    },

    show_mainForm_after_process: function () {
        All.clear_div_in_boxcontent(".nextForm1");
        All.clear_div_in_boxcontent(".nextForm2");
        All.clear_div_in_boxcontent(".nextForm3");
        All.clear_div_in_boxcontent(".nextForm4");

        All.set_all_to_display();

        $(All.get_box_content() + ".mainForm").show();
        All.clear_div_in_boxcontent(".mainForm > .result");
    },

    set_all_to_display: function () {
        $(All.get_box_content() + ".nextForm1").css('display', 'block');
        $(All.get_box_content() + ".nextForm2").css('display', 'block');
        $(All.get_box_content() + ".nextForm3").css('display', 'block');
        $(All.get_box_content() + ".nextForm4").css('display', 'block');
    },

    set_success_message: function (set_to, param) {
        set_to = set_to || "hasil";
        param = param || "Success";
        $(All.get_box_content() + set_to).html(null);
        $(All.get_box_content() + set_to).html("<div class='alert alert-success' align=center>" + param + "</div>");
    },
    num: function (val) {
        var result = val.toString().split('').reverse().join("").match(/[0-9]{1,3}/g).join(".").match(/./g).reverse().join("");
        return result;
    },

    num_normal: function (val) {
        var result = val.toString().split('').reverse().join("")
                .match(/[0-9]{1,3}/g).join("")
                .match(/./g).reverse().join("");
        return result;
    },

    nextFocus: function (h, prev, next, evt)
    {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode :
                ((evt.which) ? evt.which : evt.keyCode);
        if (charCode == 13 || charCode == 3 || charCode == 9)
        {
            h.elements[next].focus( );
            //h.elements[next].select( );
            //trans.h.value = trans.h.value.toUpperCase();
            return false;

        } else
        {
            if (charCode == 43)
            {
                h.elements[prev].focus( );
                //h.elements[next].select( );
                return false;
            }
        }
        return true
    },

    checkUncheckAll: function (theElement)
    {

        var theForm = theElement.form;

        for (z = 0; z < theForm.length; z++)
        {

            if (theForm[z].type == 'checkbox' && theForm[z].name != 'checkall')
            {
                theForm[z].checked = theElement.checked;
            }

        }
    },

    checkUncheckByClass: function (kelas, setto) {
        var tes = $(All.get_active_tab() + "." + kelas).is(':checked');
        if (tes) {
            if (kelas == "menux") {
                $(All.get_active_tab() + "." + setto).prop('checked', true);
            } else {
                $(All.get_active_tab() + "." + setto).prop('checked', true);
                $(All.get_active_tab() + "." + setto).val(1);
            }

        } else {
            if (kelas == "menux") {
                $(All.get_active_tab() + "." + setto).prop('checked', false);
            } else {
                $(All.get_active_tab() + "." + setto).prop('checked', false);
                $(All.get_active_tab() + "." + setto).val(0);
            }

        }

    },

    setValCheck: function (tes) {
        var x = tes.value;
        if (x == "0") {
            tes.value = "1";
        } else {
            tes.value = "0";
        }
    },

    should_integer: function (checkField, focusIfValid) {
        var nm = /^[0-9]+$/;
        var amount = $(All.get_active_tab() + "#" + checkField).val();

        if (amount.match(nm))
        {
            $(All.get_active_tab() + ".to_submit").removeAttr('disabled', 'yes');
            $(All.get_active_tab() + "#" + focusIfValid).focus();
        } else if (amount == '') {
            $(All.get_active_tab() + "#" + checkField).focus();

        } else
        {
            alert('Number should not negative or should not contain character');
            $(All.get_active_tab() + ".to_submit").attr('disabled', 'yes');
            $(All.get_active_tab() + "#" + checkField).focus();
            //$("#amount").focus();
        }
    },

    checkDoubleInput: function (url, param, paramValue) {
        if (paramValue !== "") {
            All.set_disable_button();
            All.get_wait_message();
            $.ajax({
                url: All.get_url(url + param + "/" + paramValue),
                type: 'GET',
                dataType: 'json',
                success:
                        function (data) {
                            All.set_enable_button();
                            if (data.response == "true") {
                                alert("Double " + param + " with value : " + paramValue);
                            }
                        },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + ':' + xhr.status);
                    All.set_enable_button();
                }
            });
        } else {
            alert("Please fill the field..");
        }
    },

    getListData: function (url) {
        All.set_disable_button();
        All.get_image_load();
        $.ajax({
            url: All.get_url(url),
            type: 'GET',
            success:
                    function (data) {
                        All.set_enable_button();
                        All.clear_div_in_boxcontent(".mainForm .result");
                        $(All.get_box_content() + ".mainForm .result").html(data);
                        //$(All.get_active_tab() + " #searchF").val(0);
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    postListData: function (formID, url) {
        All.set_disable_button();
        //All.get_image_load();
        var activeForm = $('#' + formID);
        console.log(All.get_url(url));
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formID).serialize(), function (data)
        {
            All.set_enable_button();
            All.clear_div_in_boxcontent(".mainForm > .result");
            $(All.get_box_content() + ".mainForm > .result").html(data);

        });

    },

    ajaxFormGet: function (url) {
        All.set_disable_button();
        All.get_image_load();
        $.ajax({
            url: All.get_url(url),
            type: 'GET',
            success:
                    function (data) {
                        All.set_enable_button();
                        $(All.get_active_tab() + ".result").html(null);
                        $(All.get_active_tab() + ".result").html(data);
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    ajaxFormPost: function (formID, url) {
        All.set_disable_button();
        All.get_image_load2();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formID).serialize(), function (data)
        {
            All.set_enable_button();
            $(All.get_active_tab() + ".result").html(null);
            $(All.get_active_tab() + ".result").html(data);
        }).fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    ajaxPostResetField: function (formID, url) {
        All.set_disable_button();
        All.get_image_load2();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formID).serialize(), function (data)
        {
            All.reset_all_input();
            All.set_enable_button();
            $(All.get_active_tab() + " .result").html(null);
            $(All.get_active_tab() + " .result").html(data);
        }).fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    cancelUpdateForm: function () {
        $(All.get_active_tab() + " #upd_btn").css('display', 'none');
        $(All.get_active_tab() + " #inp_btn").css('display', 'block');
        $(All.get_active_tab() + " #id").val(null);
        $(All.get_active_tab() + " .setReadOnly").removeAttr('readonly');
        $(All.get_active_tab() + " #qtyReq").removeAttr('readonly');
        All.reset_all_input();
        $(All.get_active_tab() + " #country_id").val("ID");
        $(All.get_active_tab() + " #hq_id").val("BID06");
        $(All.get_active_tab() + " #branch_id").val("B001");
        $(All.get_active_tab() + " #year").val((new Date).getFullYear());
        $(All.get_active_tab() + " .fileExistingInfo").html(null);
        $(All.get_active_tab() + " .fileHiddenExistingInfo").val(null);
    },

    ajaxShowDetailonNextForm: function (urlx) {
        All.set_disable_button();
        $.ajax({
            url: All.get_url(urlx),
            type: 'GET',
            success:
                    function (data) {
                        All.set_enable_button();
                        $(All.get_active_tab() + ".mainForm").hide();
                        All.clear_div_in_boxcontent(".nextForm1");
                        $(All.get_active_tab() + ".nextForm1").html(data);
                    },
            error: function (jqXHR, textStatus, errorThrown) {
                All.set_enable_button();
            }
        });
    },

    ajaxShowDetailonNextFormPost: function (url, formid) {
        All.set_disable_button();
        All.get_wait_message();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formid).serialize(), function (data)
        {
            All.set_enable_button();
            $(All.get_active_tab() + ".mainForm").hide();
            All.clear_div_in_boxcontent(".nextForm1");
            $(All.get_active_tab() + ".nextForm1").html(data);

        }).fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    ajaxShowDetailonNextForm2: function (urlx) {
        All.set_disable_button();
        $.ajax({
            url: All.get_url(urlx),
            type: 'GET',
            success:
                    function (data) {
                        All.set_enable_button();
                        $(All.get_active_tab() + ".nextForm1").hide();
                        All.clear_div_in_boxcontent(".nextForm2");
                        $(All.get_active_tab() + ".nextForm2").html(data);
                    },
            error: function (jqXHR, textStatus, errorThrown) {
                All.set_enable_button();
            }
        });
    },

    ajaxShowDetailonNextForm2Post: function (url, formid) {
        All.set_disable_button();
        All.get_wait_message();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formid).serialize(), function (data)
        {
            All.set_enable_button();
            $(All.get_active_tab() + ".nextForm1").hide();
            All.clear_div_in_boxcontent(".nextForm2");
            $(All.get_active_tab() + ".nextForm2").html(data);

        }).fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    inputFormData: function (url, formid) {
        All.set_disable_button();
        All.get_wait_message();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formid).serialize(), function (data)
        {
            All.set_enable_button();
            if (data.response == "false") {
                All.set_error_message(".mainForm .result", data.message);
            } else {
                All.set_success_message(".mainForm .result", data.message);
                All.reset_all_input();
            }

        }, "json").fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    ajaxPostUpdate: function (formid, formUpdate, showFormAfterPost) {

        All.set_disable_button();
        All.get_image_load();
        $.ajax({
            url: All.get_url(formUpdate),
            type: 'GET',
            dataType: "json",
            success:
                    function (data) {
                        All.set_enable_button();
                        alert(data.message);
                        if (data.response == "true") {
                            All.ajaxFormPost(formid, showFormAfterPost);
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    updateFormData: function (url, formid, nextToLoad) {
        All.set_disable_button();
        All.get_wait_message();
        $.post(All.get_url(url), $(All.get_active_tab() + "#" + formid).serialize(), function (data)
        {
            All.set_enable_button();
            alert(data.message);
            if (data.response == "true") {
                All.reset_all_input();
                All.cancelUpdateForm();
                All.getListData(nextToLoad);
            }


        }, "json").fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    },

    deleteFormData: function (url, param, nextToLoad) {
        All.set_disable_button();
        All.get_wait_message();

        $.ajax({
            url: All.get_url(url + param),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        alert(data.message);
                        if (data.response == "true") {
                            All.getListData(nextToLoad);
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });

        //alert('url :' +url+ 'param : ' +param+ 'load :' +nextToLoad);
    },

    deleteData: function (url, formID, showFormAfterPost) {
        All.set_disable_button();
        $.ajax({
            url: All.get_url(url),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        alert(data.message);
                        if (data.response == "true") {
                            //All.getListData(nextToLoad);
                            All.ajaxFormPost(formID, showFormAfterPost);
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    reconcileData: function (url, formID, showFormAfterPost) {
        All.set_disable_button();
        $.ajax({
            url: All.get_url(url),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        alert(data.message);
                        if (data.response == "true") {
                            //alert('masuk sini');				
                            //All.getListData(nextToLoad);
                            All.ajaxFormPost(formID, showFormAfterPost);
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    convertDateIndo: function (tgl, to, delimiter)
    {
        var date1 = tgl.split("/");
        var tanggal = "";
        if (to == "ymd") {
            //tanggal = date1[2] + delimiter."".date1[1]."".delimiter.date1[0];
            tanggal = tanggal.concat(date1[2], delimiter, date1[1], delimiter, date1[0]);
        } else if (to == "mdy") {
            //tanggal = date1[1]."".delimiter."".date1[0]."".delimiter.date1[2];
            tanggal = tanggal.concat(date1[1], delimiter, date1[0], delimiter, date1[2]);
        }
        return tanggal;
    },

    dinamicTabContentHeight: function () {
        $('#contentY > .ui-tabs-panel').css('max-height', $(window).height() - 115);
    },

    checkMultipleCheckbox: function (namex) {
        var atLeastOneIsChecked = $(All.get_active_tab() + "input[name='" + namex + "']:checkbox:checked").length;
        if (atLeastOneIsChecked < 1) {
            alert("Please select at least one checkbox..");
            return false;
        }
    },

    getFullNameByID: function (nilai, urlX, setValue) {
        if (nilai === "") {
            alert("Tidak boleh kosong..")
        } else {
            All.set_disable_button();
            $.ajax({
                url: All.get_url(urlX) + "/" + nilai,
                type: 'GET',
                dataType: 'json',
                success:
                        function (data) {

                            All.set_enable_button();
                            if (data.response == "true") {
                                $(All.get_active_tab() + setValue).val(data.arrayData[0].fullnm);
                            } else {
                                alert("Data " + nilai + " not found");
                                $(All.get_active_tab() + setValue).val(null);
                            }
                        },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + ':' + xhr.status);
                    All.set_enable_button();
                }
            });
        }
    },

    relogin: function (idx) {
        var reloadForm = $(All.get_active_tab() + "#form_reload").val();
        All.set_disable_button();
        All.get_wait_message();
        $.post(All.get_url("auth/inline"), $(All.get_active_tab() + "#" + idx).serialize(), function (data)
        {
            All.set_enable_button();
            if (data.response == "true") {
                All.reload_page(reloadForm);
            } else {
                alert(data.message);
            }

        }, "json").fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });
    }

    /*
     getJsonResponse : function(urlx) {
     All.set_disable_button();
     return
     $.ajax({
     url: All.get_url(urlX),
     type: 'GET',
     dataType: 'json',
     });
     }
     */

}

