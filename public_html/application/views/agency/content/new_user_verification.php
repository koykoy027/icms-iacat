<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>

    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo SITE_ASSETS ?>global/template/bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?php echo SITE_ASSETS ?>global/template/fonts/font-awesome/css/font-awesome.min.css" >
        <link rel="stylesheet" href="<?php echo SITE_ASSETS ?>global/template/fonts/font-awesome/css/font-awesome.css" >
        <style type="text/css" rel="stylesheet">

            .password-strength-indicator.very-weak
            {
                color: #cf0000; 
            }
            .weak
            {
                color: #f6891f;

            }
            .pair
            {
                color: #eeee00;
            }
            .strong
            {
                color: #99ff33;
            }
            .very-strong
            {
                color: #22cf00;
            }
            div.error{
                color: red;
            }

        </style>
    </head>
    <body style="background:#fff !important;font-family: source sans pro;overflow: hidden;">

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-6 mx-auto">

                            <!-- form card login -->
                            <div class="card rounded-10 crd-cnt" data-xp="<?= $data['isXprd'] ?>"  data-lnk="<?= $data['link'] ?>"  data-id="<?= $data['setId'] ?>" data-un="<?= $data['user_username'] ?>">
                            <div class="card-header">
                                <h3 class="mb-0">Setup Your Password Now!</h3>
                            </div>
                            <div class="card-body">
                                <form  id="formLogin">
                                    <form  id="formLogin">
                                        <div class="form-group">
                                            <h6>  <span> Your E-mail : </span><span><b><?= $data['user_email'] ?></b></span> </h6>
                                            <h6>  <span> Your Username : </span><span><b><?= $data['user_username'] ?></b></span>  </h6>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Enter Password</label> <u> <span class="spn_show" data-id="#pwd" data-s-h="0" style="float:right;margin-right: 5px;cursor:pointer;color: blue">show</span></u>
                                            <input type="password" placeholder="• • • • • • • •" name="create_password" minlength="8" maxlength="48" class="form-control form-control-lg rounded-5 limitedSpecChar" id="pwd" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label> <u> <span class="spn_show" data-id="#pwd_confirm" data-s-h="0" style="float:right;margin-right: 5px;cursor:pointer;color: blue">show</span></u>
                                            <input type="password" placeholder="• • • • • • • •" name="confirm_password" minlength="8" maxlength="48" class="form-control form-control-lg rounded-5 limitedSpecChar" id="pwd_confirm" required="" >
                                        </div>
                                        <button type="submit" class="btn btn-info btn-lg float-right" id="btn-setnow">Set Now</button>
                                    </form>
                            </div>
                            <!--/card-block-->
                        </div>
                        <!-- /form card login -->

                    </div>


                </div>
                <!--/row-->

            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->




</body>
<footer>
    <script src="<?php echo SITE_ASSETS ?>global/jquery/jquery.js"></script>
    <script src="<?php echo SITE_ASSETS ?>global/jquery/jquery.min.js"></script>
    <script src="<?php echo SITE_ASSETS ?>global/template/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_EXT_LIBRARY_PLUGIN ?>jquery.validate.min.js"></script>
    <script src="<?php echo SITE_EXT_LIBRARY_PLUGIN ?>password_strength.js"></script>
    <script src="<?php echo SITE_ASSETS ?>modules/agency/js/new_user_verification.js"></script>
    <script src="<?php echo SITE_ASSETS ?>modules/agency/js/config.js"></script>
    <script src="/assets/library/js/global_methods.js"  type="text/javascript" ></script>
    <script src="/assets/library/js/icms_message.js"  type="text/javascript" ></script>   

</footer>
</html>



<div class="modal " id="warning_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning</h5>

            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-login">Try to Login</button>
            </div>
        </div>
    </div>
</div>


<div class="modal " id="save_confirm_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-title-conf">Confirmation</h5>

            </div>
            <div class="modal-body modal-body-conf">
                <p>Click save to set password</p>
            </div>
            <div class="modal-footer modal-footer-conf">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-save">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="icmsMessage"></div>