var $ = jQuery;

var Userconfig = {
    getUpdateUserGroup: function (param) {
        All.set_disable_button();
        All.get_wait_message();
        var id = $(All.get_active_tab() + " #gid" + param).val();
        $.ajax({
            url: All.get_url("user/group/id/" + id),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            //All.clear_div_in_boxcontent(".mainForm > .result");
                            //$(All.get_box_content() + ".mainForm > #formInputNews").show();
                            All.formUpdateActivate();
                            $(All.get_active_tab() + " #id").val(data.arrayData[0].groupid);
                            $(All.get_active_tab() + " #groupname").val(data.arrayData[0].groupname);


                            //$(All.get_active_tab() + " #parentID").val(data.arraydata[0].orderlist);
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    refreshListUserGroup: function (set_to) {
        All.set_disable_button();
        All.get_wait_message();
        $.ajax({
            url: All.get_url("user/group/list/json"),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            var arrayData = data.arrayData;
                            $(All.get_active_tab() + set_to).html(null);
                            var rowhtml = "<option value=''>--Select here--</option>";
                            $.each(arrayData, function (key, value) {
                                rowhtml += "<option  value=" + value.groupid + ">" + value.groupname + "</option>";
                            });
                            $(All.get_active_tab() + set_to).append(rowhtml);
                        } else {

                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getUpdateUser: function (param) {
        All.set_disable_button();
        All.get_wait_message();
        var id = $(All.get_active_tab() + " #usrname" + param).val();
        $.ajax({
            url: All.get_url("user/id/" + id),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            //All.clear_div_in_boxcontent(".mainForm > .result");
                            //$(All.get_box_content() + ".mainForm > #formInputNews").show();
                            All.formUpdateActivate();
                            $(All.get_active_tab() + " #username").val(data.arrayData[0].username);
                            $(All.get_active_tab() + " #password").val(data.arrayData[0].password);
                            $(All.get_active_tab() + " #status").val(data.arrayData[0].status);
                            $(All.get_active_tab() + " #branchid").val(data.arrayData[0].branchid);
                            $(All.get_active_tab() + " #departmentid").val(data.arrayData[0].departmentid);
                            $(All.get_active_tab() + " #groupid").val(data.arrayData[0].groupid);

                            //$(All.get_active_tab() + " #parentID").val(data.arraydata[0].orderlist);
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getUpdateApp: function (param) {
        All.set_disable_button();
        All.get_wait_message();
        var id = $(All.get_active_tab() + " #appid" + param).val();
        $.ajax({
            url: All.get_url("app/id/" + id),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            //All.clear_div_in_boxcontent(".mainForm > .result");
                            //$(All.get_box_content() + ".mainForm > #formInputNews").show();
                            All.formUpdateActivate();
                            $(All.get_active_tab() + " #app_id").val(data.arrayData[0].app_id);
                            $(All.get_active_tab() + " #app_name").val(data.arrayData[0].app_name);
                            $(All.get_active_tab() + " #app_url").val(data.arrayData[0].app_url);
                            $(All.get_active_tab() + " #status").val(data.arrayData[0].status);

                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getUpdateGroupMenu: function (param) {
        All.set_disable_button();
        All.get_wait_message();
        var id = $(All.get_active_tab() + " #gmenu_id" + param).val();
        $.ajax({
            url: All.get_url("menu/group/id/" + id),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            //All.clear_div_in_boxcontent(".mainForm > .result");
                            //$(All.get_box_content() + ".mainForm > #formInputNews").show();
                            All.formUpdateActivate();
                            $(All.get_active_tab() + " #id").val(data.arrayData[0].app_menu_id);
                            $(All.get_active_tab() + " #app_id").val(data.arrayData[0].app_id);
                            $(All.get_active_tab() + " #app_submenu_prefix").val(data.arrayData[0].app_submenu_prefix);
                            $(All.get_active_tab() + " #app_menu_desc").val(data.arrayData[0].app_menu_desc);
                            $(All.get_active_tab() + " #menu_order").val(data.arrayData[0].menu_order);
                            $(All.get_active_tab() + " #status").val(data.arrayData[0].status);

                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    refreshListApp: function (set_to) {
        All.set_disable_button();
        All.get_wait_message();
        $.ajax({
            url: All.get_url("app/list/json"),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            var arrayData = data.arrayData;
                            $(All.get_active_tab() + set_to).html(null);
                            var rowhtml = "<option value=''>--Select here--</option>";
                            $.each(arrayData, function (key, value) {

                                rowhtml += "<option  value=" + value.app_id + ">" + value.app_name + "</option>";
                            });
                            $(All.get_active_tab() + set_to).append(rowhtml);
                        } else {

                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getUpdateSubMenu: function (param) {
        All.set_disable_button();
        All.get_wait_message();
        var id = $(All.get_active_tab() + " #menu_id" + param).val();
        $.ajax({
            url: All.get_url("menu/id/" + id),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            //All.clear_div_in_boxcontent(".mainForm > .result");
                            //$(All.get_box_content() + ".mainForm > #formInputNews").show();
                            All.formUpdateActivate();
                            $(All.get_active_tab() + " #id").val(data.arrayData[0].app_menu_id);
                            $(All.get_active_tab() + " #app_menu_desc").val(data.arrayData[0].app_menu_desc);
                            $(All.get_active_tab() + " #app_menu_url").val(data.arrayData[0].app_menu_url);
                            $(All.get_active_tab() + " #app_menu_parent_id").val(data.arrayData[0].app_menu_parent_id);
                            $(All.get_active_tab() + " #menu_order").val(data.arrayData[0].menu_order);
                            $(All.get_active_tab() + " #status").val(data.arrayData[0].status);

                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getInfoGroupMenu: function (param) {
        if (param !== "")
        {
            All.set_disable_button();
            All.get_wait_message();
            var id = $(All.get_active_tab() + " #menu_id" + param).val();
            $.ajax({
                url: All.get_url("menu/group/id/" + param),
                type: 'GET',
                dataType: 'json',
                success:
                        function (data) {
                            All.set_enable_button();
                            if (data.response == "true") {
                                $(All.get_active_tab() + " #app_id").val(data.arrayData[0].app_id);
                                $(All.get_active_tab() + " #app_submenu_prefix").val(data.arrayData[0].app_submenu_prefix);

                            }
                        },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + ':' + xhr.status);
                    All.set_enable_button();
                }
            });
        } else {
            $(All.get_active_tab() + " #app_id").val(null);
            $(All.get_active_tab() + " #app_submenu_prefix").val(null);
        }
    },

    refreshListGroupMenu: function (set_to) {
        All.set_disable_button();
        All.get_wait_message();
        $.ajax({
            url: All.get_url("menu/group/list/json"),
            type: 'GET',
            dataType: 'json',
            success:
                    function (data) {
                        All.set_enable_button();
                        if (data.response == "true") {
                            var arrayData = data.arrayData;
                            $(All.get_active_tab() + set_to).html(null);
                            var rowhtml = "<option value=''>--Select here--</option>";
                            $.each(arrayData, function (key, value) {

                                rowhtml += "<option  value=" + value.app_menu_id + ">" + value.app_menu_desc + "</option>";
                            });
                            $(All.get_active_tab() + set_to).append(rowhtml);
                        } else {

                        }
                    },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + ':' + xhr.status);
                All.set_enable_button();
            }
        });
    },

    getListAllMenuConfig: function () {
        var groupid = $(All.get_active_tab() + " #groupid").val();
        if (groupid !== "") {
            All.set_disable_button();
            All.get_image_load();
            $.post(All.get_url('menu/check'), $(All.get_active_tab() + " #formInputAccessMenu").serialize(), function (data)
            {
                All.set_enable_button();
                All.clear_div_in_boxcontent(".mainForm > .result");
                $(All.get_box_content() + ".mainForm > .result").html(data);

            }).fail(function () {
                alert("Error requesting page");
                All.set_enable_button();
            });
        } else {
            alert("Please select User Group..!!!");
        }
    },

    saveInputAccessMenu: function () {

        All.set_disable_button();
        All.get_image_load();
        $.post(All.get_url('menu/check'), $(All.get_active_tab() + " #formInputAccessMenu").serialize(), function (data)
        {
            All.set_enable_button();
            All.clear_div_in_boxcontent(".mainForm > .result");
            $(All.get_box_content() + ".mainForm > .result").html(data);

        }).fail(function () {
            alert("Error requesting page");
            All.set_enable_button();
        });

    }
}