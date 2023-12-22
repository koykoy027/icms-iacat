<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>





<div class="modal" id="msgmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="margin-top: 30%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header"> Please wait...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body msgmodal-body">

            </div>
            <div class="modal-footer msgmodal-footer">
            </div>
        </div>
    </div>
</div>



</div <!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <a target="_blank" href="" class="footer-content"></a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->






<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div>
</body>


<footer>

    <!-- jQuery library -->
    <script src="<?= SITE_ASSETS ?>global/jquery/jquery.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/js/polyfill.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/js/listeners.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/js/index.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/js/util.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/js/bs-stepper.min.js"></script>

    <!-- Bootstrap JS library -->
    <script src="<?= SITE_ASSETS ?>global/template/bootstrap/js/bootstrap.min.js"></script>


    <script src="/assets/modules/icms/js/header.js" type="text/javascript"></script>


    <!--
-- Custom  JS / CSS :: Flexible 
-- Automatic injection for internal resources
-- Make sure these code is injected to all footer
-->
    <?php
$dir_asset = [];

$dir_asset['panel'] = trim($this->session->userdata('panel'));
$dir_asset['page'] = trim($this->session->userdata('menu'));

$dir_asset['js'] = BASE_MODULES . $dir_asset['panel'] . DS . 'js' . DS;
$dir_asset['css'] = BASE_MODULES . $dir_asset['panel'] . DS . 'css' . DS;
$dir_asset['addJS'] = BASE_EXT_LIBRARY . 'js' . DS;
$dir_asset['addCSS'] = BASE_EXT_LIBRARY . 'css' . DS;

_assetLibrary($libraries, $dir_asset);
?>

</footer>

</html>