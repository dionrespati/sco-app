<?php
//$sess = $this->session->userdata('username');	
?>
<!---
BATAS
--->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--<meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">-->
        <?php
        if ($this->groupid == 8 || $this->groupid == 9) {
            $title = "K-LINK WMS";
        } else {
            if ($this->stockist == "BID06") {
                $title = "K-LINK Back Office";
            } else {
                $title = "K-LINK SCO";
            }
        }
        ?>
        <title><?php echo $title; ?></title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>

        <!-- tambahan Hilal -->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/img_caption.css'); ?>"/>
        <!-- End tambahan Hilal -->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/bootstrap-cerulean.css'); ?>"/>
        <!-- link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" -->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/bootstrap-responsive.css'); ?>"/>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/jquery-ui-1.8.21.custom.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/fullcalendar.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/fullcalendar.print.css') ?>" />


        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/theme.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/font-awesome/css/font-awesome.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/DT_bootstrap.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/css/jquery.cleditor.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/backend.css'); ?>"/>
        <!--<script src="<?php echo base_url('assets/css/bootstrap/js/jquery-1.8.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/css/bootstrap/js/jquery-ui-1.8.21.custom.min.js') ?>"></script> -->


        <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> -->
        <!--<link href="http://hayageek.github.io/jQuery-Upload-File/uploadfile.min.css" rel="stylesheet">-->
        <script src="<?php echo base_url('assets/css/bootstrap/js/jquery-1.9.1.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/highcharts.js') ?>"></script>
        <!--<script src="http://hayageek.github.io/jQuery-Upload-File/jquery.uploadfile.min.js"></script>-->
        <!--<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
        <script src="<?php echo base_url('assets/css/bootstrap/js/jquery-ui-1.10.3.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/css/bootstrap/js/jquery.cleditor.min.js') ?>"></script>

<!--<script src="<?php echo base_url('js/ckeditor/ckeditor.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('js/ajaxfileupload.js') ?>"></script>-->
        <!-- Demo page code -->

        <style type="text/css">
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .brand { font-family: georgia, serif; }
            .brand .first {
                color: #ccc;
                font-style: italic;
            }
            .brand .second {
                color: #fff;
                font-weight: bold;
            }


        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    </head>

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7"> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8"> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9"> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!-->
    <!--
    <script type="text/javascript" src="<?php echo base_url('assets/css/bootstrap/js/jquery.js'); ?>"></script> 
    <script src="<?php echo base_url('assets/css/bootstrap/js/jquery-1.8.1.min.js'); ?>" type="text/javascript"></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/css/bootstrap/js/bootstrap.js'); ?>"></script>

<!--<script src="<?php echo base_url('assets/css/bootstrap/js/jquery.ui.core.js') ?>"></script>
<script src="<?php echo base_url('assets/css/bootstrap/js/jquery.ui.widget.js') ?>"></script>


<script src="<?php echo base_url('assets/css/bootstrap/js/jquery-ui.js') ?>"></script>-->
    <script src="<?php echo base_url('assets/css/bootstrap/js/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/css/bootstrap/js/DT_bootstrap.js') ?>"></script>   

    <!-- LOAD MODULE FOR KSYSTEM APPLICATION -->
    <script src="<?php echo base_url('assets/js_module/config.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/global.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/userconfig.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/stockist.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/member.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/warehouse.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/stockbarcode.js') ?>" ></script>
    <script src="<?php echo base_url('assets/js_module/paystk.js') ?>" ></script>
    <!--<script src="<?php echo base_url('js/ks_module.js') ?>" ></script>
<body> 
    <!--<![endif]-->

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <ul class="nav pull-right">

                    <li id="fat-menu" class="dropdown">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> &nbsp;&nbsp;<?php echo $this->username . " / " . $this->stockist; ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="<?php echo $logout; ?>">Logout</a></li>
                        </ul>
                    </li>

                </ul>
                <a class="brand"><span class="first"><?php echo $title; ?></span> <span class="second">Application</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

            </div>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row-fluid">
            <div class="span3">
                <div class="sidebar-nav">  
                    <?php
                    echo $menu;
                    ?>
                </div>  
            </div>

            <div class="span9" id="contentX">
                <div id="tabs">
                    <ul id="ul_head">


                    </ul>
                    <div id="contentY">

                    </div>
                </div>
            </div>
        </div> <!--END row-fluid -->   
    </div> <!--END container-fluid -->   
    <!--<footer>
        <p class="pull-right"><?php echo $title; ?> Application&nbsp;&copy; 2017</p>
    </footer>-->




    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        var menu_array = [];
        $(function () {
            $("#tabs").tabs();
            $(".ss").click(function () {
                /* var isi = $(this).attr('id');
                 $("#contentX").html('<center><img src=http://www.k-linkmember.co.id/ksystemx/images/ajax-loader2.gif ></center>');  
                 //$.preload('<center><img src=http://www.k-linkmember.co.id/ksystem/images/ajax-loader2.gif ></center>');
                 $("#contentX").load(isi, function(response, status, xhr) {
                 if (status == "error") {
                 alert("The page you are requesting is not found, Error status :" +xhr.status);
                 }
                 }); */
                var id_menu = $(this).attr('rel');
                var text = $(this).text();
                var isi = $(this).attr('id');
                var check_menu = $.inArray(id_menu, menu_array);
                if (check_menu >= 0) {
                    alert("Menu " + text + " is already opened..!!");
                } else {

                    var tab_qty = parseInt($("#tab_qty").val());
                    var tab_jums = parseInt($("#tab_jum").val());
                    var next = tab_qty + 1;
                    var tab_remain = tab_jums + 1;
                    /* create close btn */
                    var btnCloseTab = $("<span rel='#tabs-" + next + "' id=" + id_menu + " class='remove-tab'>X</span>");
                    /* bind click event to close-btn */

                    /* create tabulator */
                    var rowshtml = $("<li class='ui-state-default ui-corner-top' role='tab' tabindex='-1' aria-controls='tabs-" + next + "' aria-labelledby='ui-id-" + next + "' aria-selected='false' ></li>");
                    /* create link in tabulator */
                    var rowshtml_link = $("<a id='ui-id-" + next + "'  class='ui-tabs-anchor' href='#tabs-" + next + "' role='presentation' tabindex='-1' onclick=get_tab_number(" + next + ")>" + text + "</a>");
                    /* append link inside tabulator */
                    rowshtml.append($(rowshtml_link));
                    /* append close button inside tabulator */
                    rowshtml.append($(btnCloseTab));

                    /* create content */
                    var rowshtml2 = $("<div id='tabs-" + next + "' class='ui-tabs-panel ui-widget-content ui-corner-bottom' aria-labelledby='ui-id-" + next + "' role='tabpanel' style='display: none;' aria-expanded='false' aria-hidden='true'></div>");

                    $("#ul_head").append(rowshtml);
                    $("#contentY").append(rowshtml2);
                    $("#tabs").tabs("refresh");

                    $("#tabs-" + next).load(isi, function (response, status, xhr) {
                        if (status == "error") {
                            alert("The page you are requesting is not found, Error status :" + xhr.status);
                        }

                        //$("#tabs-" +next).css('display', 'block');
                        //be_umroh.getTipeJamaah(); 
                        All.dinamicTabContentHeight();
                    });

                    $("#tab_qty").val(next);
                    $("#tab_jum").val(tab_remain);
                    $("#tabs").tabs({active: (tab_qty)});

                    $("#active_div").val(next);

                    menu_array.push(id_menu);

                    btnCloseTab.click(function (e) {
                        var refNumber = $(this).attr('rel');
                        var refid = $(this).attr('id');
                        var idx_menu = menu_array.indexOf(refid);
                        if (idx_menu != -1) {
                            menu_array.splice(idx_menu, 1);
                        }
                        e.preventDefault();

                        var linkToRemove = $('#ul_head').find('a[href="' + refNumber + '"]');
                        var tabToRemove = $(linkToRemove).parent();

                        $(tabToRemove).remove();

                        $(refNumber).remove();
                        //$("#tabs").tabs("refresh");
                        var x = parseInt($("#tab_jum").val());
                        var min_tab = x - 1;
                        var initial_x = 1;
                        if (x == 1) {
                            $("#tab_qty").val(0);
                            $("#tab_jum").val(0);
                            $("#active_div").val(0);

                        } else {
                            $("#tab_jum").val(min_tab);
                            $("#active_div").val(initial_x);
                            $("#tabs").tabs({active: (0)});


                            //alert('isi : ' +$("#active_div").val());
                        }

                        //console.log(menu_array);
                        //console.log(check_menu); 
                    });


                }
                //$("#tab_qty").val(next);
                //$("#tabs").tabs("refresh");
                // console.log(menu_array);
                // console.log(check_menu); 



            });

            $(All.get_active_tab() + ' .uppercase').bind('change', function () {
                //$(this).val($(this).val().toUpperCase().replace(/'/g,"`"));
                alert("ok");
            });

        });


        function get_tab_number(idx)
        {

            $("#active_div").val(idx);
        }

    </script>

    <input type="hidden" id="tab_qty" value="0" />
    <input type="hidden" id="tab_jum" value="0" />
    <input type="hidden" id="active_div" value="0" />
</body>
</html>    


