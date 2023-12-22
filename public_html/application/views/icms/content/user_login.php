<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo SITE_ASSETS ?>global/template/bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?php echo SITE_ASSETS ?>global/template/fonts/font-awesome/css/font-awesome.min.css" >
        <link rel="stylesheet" href="<?php echo SITE_ASSETS ?>global/template/fonts/font-awesome/css/font-awesome.css" >

    </head>
    <!--Coded with love by Mutiullah Samim-->
    <body>
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="<?php echo SITE_ASSETS ?>global/images/icms.png" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form id="frm_login">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="txt_user" class="form-control input_user" value="" placeholder="juandelacruz@email.com">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="txt_pass" class="form-control input_pass" value="" placeholder="••••••••">
                            </div>

                        </form>
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="button" class="btn login_btn">Login</button>
                    </div>
                    <div class="mt-4">

                        <div class="d-flex justify-content-center links">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>



        <div class="modal" id="msgmodal"  tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" style="margin-top: 30%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h5-title"> Please wait...</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="p-msg">
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <script src="<?php echo SITE_ASSETS ?>global/jquery/jquery.js"></script>
        <script src="<?php echo SITE_ASSETS ?>global/jquery/jquery.min.js"></script>
        <script src="<?php echo SITE_ASSETS ?>global/template/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo SITE_EXT_LIBRARY_PLUGIN ?>jquery.validate.min.js"></script>
        <script src="<?php echo SITE_ASSETS ?>modules/icms/js/user_login.js"></script>
        <script src="<?php echo SITE_ASSETS ?>modules/icms/js/config.js"></script>
    </footer>
</html>


<style>
    /* Coded with love by Mutiullah Samim */
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: #6c757d !important;
    }
    .user_card {
        height: 400px;
        width: 350px;
        margin-top: auto;
        margin-bottom: auto;
        background: #e88f15;
        position: relative;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 5px;

    }
    a{
        text-decoration:none;
        & :hover{
            text-decoration:none;
        }
    }
    .brand_logo_container {
        position: absolute;
        height: 170px;
        width: 170px;
        top: -75px;
        border-radius: 50%;
        background: #f8f9fa;
        padding: 10px;
        text-align: center;
    }
    .brand_logo {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        border: 2px solid white;
    }
    .form_container {
        margin-top: 100px;
    }
    .login_btn {
        width: 100%;
        background: #333c48 !important;
        color: white !important;
    }
    .login_btn:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
    .login_container {
        padding: 0 2rem;
    }
    .input-group-text {
        background: #333c48 !important;
        color: white !important;
        border: 0 !important;
        border-radius: 0.25rem 0 0 0.25rem !important;
    }
    .input_user,
    .input_pass:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
        background-color: #c0392b !important;
    }
</style>