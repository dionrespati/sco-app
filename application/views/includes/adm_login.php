<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>K-LINK Back End Apps</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="k-link, responsive, HTML5, K-System Online"/>
        <meta name="author" content="k-link"/>

        <!-- The styles -->
        <link  href="<?php echo base_url('assets/css/bootstrap/css/bootstrap-cerulean.css') ?>" rel="stylesheet"/>
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="<?php echo base_url('assets/css/bootstrap/css/bootstrap-responsive.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/charisma-app.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/jquery-ui-1.8.21.custom.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/chosen.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/uniform.default.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/colorbox.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/jquery.noty.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/noty_theme_default.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/elfinder.min.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/elfinder.theme.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/jquery.iphone.toggle.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/opa-icons.css') ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/bootstrap/css/uploadify.css') ?>" rel="stylesheet"/>
    </head>
    <body>

        <div  class="container-fluid">
            <div class="row-fluid">

                <div align="center" class="row-fluid">
                    <div>
                        <img width="140px" height="120px" src="<?php echo base_url('assets/images/klinklogo.jpg') ?>" />
                    </div>
                    <!--
                    <div class="span12 center login-header">
                            
                            
                    </div><!--/span-->
                </div><!--/row-->

                <div align="center"  class="row-fluid">
                    <div class="well span5 center login-box">
                        <div class="alert alert-info">
                            <h3>K-LINK Web Application</a></h3>
                        </div>
                        <form class="form-horizontal" action="<?php echo $formAction; ?>" method="post">
                            <fieldset>
                                <div class="input-prepend" title="Username" data-rel="tooltip"/>
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input autofocus class="input-large span10" name="username" id="username" type="text" placeholder="Username" />
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="Password" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-lock"></i></span>
                                    <input class="input-large span10" name="password" id="password" type="password" placeholder="Password" />
                                </div>
                                <div class="clearfix"></div>

                                <p class="center span5">
                                    <button type="submit" class="btn btn-primary" name="submit">Login</button>

                                </p>
                            </fieldset>
                        </form>
                    </div><!--/span-->
                </div><!--/row-->
            </div><!--/fluid-row-->

        </div><!--/.fluid-container-->
        <div align="center">
            <font color="red">
            <?php
            if (isset($error_message)) {
                echo $error_message;
            }
            ?>
            </font>  
        </div>
        <!-- external javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <noscript>
        <div class="alert alert-block span10">
            <h4 class="alert-heading">Warning!</h4>
            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
        </div>
        </noscript>

    </body>
</html>