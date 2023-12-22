<?php
/**
 * Page Security 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function _assetTemplateLoader() {
    
}

function _assetGlobalLoader($sFileName) {

    if (file_exists(BASE_GLOBAL_VIEW . $sFileName . '.php') !== false) {
        require(BASE_GLOBAL_VIEW . $sFileName . '.php');
    } else {
        die("Global view  is not loaded");
    }
}

function _getThirdPartyLibrary($sFileName) {

    if (file_exists(THIRD_PARTY_PATH . $sFileName . '.php') !== false) {
        require(THIRD_PARTY_PATH . $sFileName . '.php');
    } else {
        //die("Third party library is not active.");
    }
}

function _assetLibrary($aLibraries, $dir_asset) {
    ?>

    <!-- Global JS  Configuration -->

    <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'config.js' ?>"  type="text/javascript" ></script>

    <!--Include Libraries -->
    <?php
    foreach ($aLibraries as $key => $val) {
        if (strtolower($key) == 'js') {
            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists($dir_asset['addJS'] . $pval . '.js') === true) {
                        ?>
                        <script src="<?= PATH_EXT_LIBRARY . 'js' . DS . $pval . '.js' ?>"  type="text/javascript" ></script>
                        <?php
                    }
                }
            } else {
                if (file_exists($dir_asset['addJS'] . $val . '.js') === true) {
                    ?>
                    <script src="<?= PATH_EXT_LIBRARY . 'js' . DS . $val . '.js' ?>"  type="text/javascript" ></script>
                    <?php
                }
            }
        }

        if (strtolower($key) == 'css') {


            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists($dir_asset['addCSS'] . $pval . '.css') === true) {
                        ?>
                        <link href="<?= PATH_EXT_LIBRARY . 'css' . DS . $pval . '.css' ?>" rel="stylesheet" type="text/css"/>
                        <?php
                    }
                }
            } else {

                if (file_exists($dir_asset['addCSS'] . $val . '.css') === true) {
                    ?>
                    <link href="<?= PATH_EXT_LIBRARY . 'css' . DS . $val . '.css' ?>" rel="stylesheet" type="text/css"/>
                    <?php
                }
            }
        }


        if (strtolower($key) == 'plugin') {


            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists(BASE_EXT_LIBRARY_PLUGIN . $pval) !== false) {

                        $extension = @end(@explode(".", $pval));
                        switch ($extension) {
                            case 'js':
                                ?>
                                <script src="<?= PATH_EXT_LIBRARY_PLUGIN . $pval ?>"  type="text/javascript" ></script>
                                <?php
                                break;

                            case 'css':
                                ?>
                                <link href="<?= PATH_EXT_LIBRARY_PLUGIN . $pval ?>" rel="stylesheet" type="text/css"/>
                                <?php
                                break;
                        }
                    }
                }
            } else {

                if (file_exists(BASE_EXT_LIBRARY_PLUGIN . $val) !== false) {

                    $extension = @end(@explode(".", $val));
                    switch ($extension) {
                        case 'js':
                            ?>
                            <script src="<?= PATH_EXT_LIBRARY_PLUGIN . $val ?>"  type="text/javascript" ></script>
                            <?php
                            break;

                        case 'css':
                            ?>
                            <link href="<?= PATH_EXT_LIBRARY_PLUGIN . $val ?>" rel="stylesheet" type="text/css"/>
                            <?php
                            break;
                    }
                }
            }
        }

        if (strtolower($key) == 'sub_js') {

            $bool = _toBool($val);
            if ($bool === true) {
                $sub_files = scandir(BASE_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'sub_' . $dir_asset['page']);

                foreach ($sub_files as $key => $val) {
                    if (!($val == '.' || $val == '..')) {
                        ?>
                        <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'sub_' . $dir_asset['page'] . DS . $val ?>"  type="text/javascript" ></script>
                        <?php
                    }
                }
            }
        }
    }
    ?>
    <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'global.js' ?>"  type="text/javascript" ></script>
    <?php
// CSS for Specific Page
    if (file_exists($dir_asset['css'] . $dir_asset['page'] . '.css') === true) {
        ?>
        <link href="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'css' . DS . $dir_asset['page'] . '.css' ?>" rel="stylesheet" type="text/css"/>
    <?php } ?>
    <?php
// Javascript for Specific Page
    if (file_exists($dir_asset['js'] . $dir_asset['page'] . '.js') === true) {
        ?>
        <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . $dir_asset['page'] . '.js' ?>"  type="text/javascript" ></script>
        <!-- we're the legends  -->
        <?php
    }
}

function _assetHeaderLibrary($aLibraries, $dir_asset) {
    ?>
    <!--Include Libraries -->
    <?php
    foreach ($aLibraries as $key => $val) {

        if (strtolower($key) == 'css') {
            if (is_array($val) !== false) {
                foreach ($val as $pkey => $pval) {

                    if (file_exists($dir_asset['addCSS'] . $pval . '.css') === true) {
                        ?>
                        <link href="<?= PATH_EXT_LIBRARY . 'css' . DS . $pval . '.css' ?>" rel="stylesheet" type="text/css"/>
                        <?php
                    }
                }
            } else {
                if (file_exists($dir_asset['addCSS'] . $val . '.css') === true) {
                    ?>
                    <link href="<?= PATH_EXT_LIBRARY . 'css' . DS . $val . '.css' ?>" rel="stylesheet" type="text/css"/>
                    <?php
                }
            }
        }


        if (strtolower($key) == 'plugin') {


            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists(BASE_EXT_LIBRARY_PLUGIN . $pval) !== false) {

                        $extension = @end(@explode(".", $pval));
                        switch ($extension) {

                            case 'css':
                                ?>
                                <link href="<?= PATH_EXT_LIBRARY_PLUGIN . $pval ?>" rel="stylesheet" type="text/css"/>
                                <?php
                                break;
                        }
                    }
                }
            } else {

                if (file_exists(BASE_EXT_LIBRARY_PLUGIN . $val) !== false) {

                    $extension = @end(@explode(".", $val));
                    switch ($extension) {

                        case 'css':
                            ?>
                            <link href="<?= PATH_EXT_LIBRARY_PLUGIN . $val ?>" rel="stylesheet" type="text/css"/>
                            <?php
                            break;
                    }
                }
            }
        }
    }

// CSS for Specific Page
    if (file_exists($dir_asset['css'] . $dir_asset['page'] . '.css') === true) {
        ?>
        <link href="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'css' . DS . $dir_asset['page'] . '.css' ?>" rel="stylesheet" type="text/css"/>
        <?php
    }
}

function _assetFooterLibrary($aLibraries, $dir_asset) {
    ?>
    <!-- Include Libraries -->
    <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'config.js' ?>"  type="text/javascript" ></script>
    <?php
    foreach ($aLibraries as $key => $val) {

        if (strtolower($key) == 'sub_js') {

            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists($dir_asset['js'] . $pval . '.js') === true) {
                        ?>
                        <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . $pval . '.js' ?>"  type="text/javascript" ></script>
                        <?php
                    }
                }
            } else {
                if (file_exists($dir_asset['js'] . $val . '.js') === true) {
                    ?>
                    <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . $val . '.js' ?>"  type="text/javascript" ></script>
                    <?php
                }
            }
        }

        if (strtolower($key) == 'js') {

            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists($dir_asset['addJS'] . $pval . '.js') === true) {
                        ?>
                        <script src="<?= PATH_EXT_LIBRARY . 'js' . DS . $pval . '.js' ?>"  type="text/javascript" ></script>
                        <?php
                    }
                }
            } else {
                if (file_exists($dir_asset['addJS'] . $val . '.js') === true) {
                    ?>
                    <script src="<?= PATH_EXT_LIBRARY . 'js' . DS . $val . '.js' ?>"  type="text/javascript" ></script>
                    <?php
                }
            }
        }


        if (strtolower($key) == 'plugin') {
            if (is_array($val) !== false) {

                foreach ($val as $pkey => $pval) {

                    if (file_exists(BASE_EXT_LIBRARY_PLUGIN . $pval) !== false) {

                        $extension = @end(@explode(".", $pval));
                        switch ($extension) {
                            case 'js':
                                ?>
                                <script src="<?= PATH_EXT_LIBRARY_PLUGIN . $pval ?>"  type="text/javascript" ></script>
                                <?php
                                break;
                            default:
                        }
                    }
                }
            } else {

                if (file_exists(BASE_EXT_LIBRARY_PLUGIN . $val) !== false) {

                    $extension = @end(@explode(".", $val));
                    switch ($extension) {
                        case 'js':
                            ?>
                            <script src="<?= PATH_EXT_LIBRARY_PLUGIN . $val ?>"  type="text/javascript" ></script>
                            <?php
                            break;
                         default:
                    }
                }
            }
        }

        if (strtolower($key) == 'sub_js') {

            $bool = _toBool($val);
            if ($bool === true) {
                $sub_files = scandir(BASE_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'sub_' . $dir_asset['page']);

                foreach ($sub_files as $key => $val) {
                    if (!($val == '.' || $val == '..')) {
                        ?>
                        <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'sub_' . $dir_asset['page'] . DS . $val ?>"  type="text/javascript" ></script>
                        <?php
                    }
                }
            }
        }
    }
    ?>
    <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . 'global.js' ?>"  type="text/javascript" ></script>
    <?php
// Javascript for Specific Page
    if (file_exists($dir_asset['js'] . $dir_asset['page'] . '.js') === true) {
        ?>
        <script src="<?= PATH_MODULES . $dir_asset['panel'] . DS . 'js' . DS . $dir_asset['page'] . '.js' ?>"  type="text/javascript" ></script>
        <!-- we're the legends  -->
        <?php
    }
}

function _toBool($val) {
    if (!is_string($val))
        return (bool) $val;
    switch (strtolower($val)) {
        case '1':
        case 'true':
        case 'on':
        case 'yes':
        case 'y':
            return true;
        default:
            return false;
    }
}
