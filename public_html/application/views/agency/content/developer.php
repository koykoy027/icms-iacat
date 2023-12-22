<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="dev-header">
    <div class="row">
        <div class="col-8">
            <div class="header-navigation " class="topnav" id="myTopnav">
                <ul class="nav nav-pills mb-3 nav-items-tab" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#v-pills-blank-page" role="tab" aria-controls="v-pills-blank-page" aria-selected="true">Blank Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#v-pills-forms" role="tab" aria-controls="v-pills-forms" aria-selected="false">Forms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#v-pills-list" role="tab" aria-controls="v-pills-list" aria-selected="false">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#v-pills-table" role="tab" aria-controls="v-pills-table" aria-selected="false">Table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#v-pills-modal" role="tab" aria-controls="v-pills-modal" aria-selected="false">Modal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#v-pills-alerts" role="tab" aria-controls="v-pills-alerts" aria-selected="false">Alerts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="pill" href="#v-pills-label" role="tab" aria-controls="v-pills-label" aria-selected="false">Label</a>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>



<div id="v-pills-blank-page " class="col-12">
    <?php
    __loadPage("sub_developer/blank_page");
    ?>
</div>


<div id="v-pills-forms" class="col-12">
    <?php
    __loadPage("sub_developer/forms");
    ?>
</div>
<div id="v-pills-modal" class="col-12">
    <?php
    __loadPage("sub_developer/modal");
    ?>
</div>
<div id="v-pills-list" class="col-12">
    <?php
    __loadPage("sub_developer/list");
    ?>
</div>