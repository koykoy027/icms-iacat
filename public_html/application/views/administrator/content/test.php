<?php

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body" style="height:650px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="card-content" style="border:0px solid #eee;">
                             
                                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" data-toggle="pill" href="#tab-civil_status" role="tab" aria-controls="v-pills-home" aria-selected="true">Civil Status</a>
                                    <a class="nav-link" data-toggle="pill" href="#tab-department_type" role="tab" aria-controls="v-pills-profile" aria-selected="false">Departure Type</a>
                                    <a class="nav-link" data-toggle="pill" href="#tab-education" role="tab" aria-controls="v-pills-messages" aria-selected="false">Education</a>
                                    <a class="nav-link" data-toggle="pill" href="#tab-employment_type" role="tab" aria-controls="v-pills-settings" aria-selected="false">Employment Type</a>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="card-content table-list"  style="border:1px solid #eee;height:300px;">

                                <div class="tab-content">                                        

                                    <div class="tab-pane fade show active" id="tab-civil_status" role="tabpanel">
                                        <span class="card-title text-left">MANAGE <span>CIVIL STATUS</span> INFORMATION </span>
                                        <span class="float-right"> <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalAddParameter" > ADD </button> </span>
                                    </div>

                                    <div class="tab-pane fade" id="tab-department_type" role="tabpanel">
                                        <span class="card-title text-left">MANAGE <span>DEPARTMENT TYPE</span> INFORMATION </span>
                                        <span class="float-right"> <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalAddParameter"> ADD </button> </span>
                                    </div>

                                    <div class="tab-pane fade" id="tab-education" role="tabpanel">
                                        <span class="card-title text-left">MANAGE <span>EDUCATION</span> INFORMATION </span>
                                        <span class="float-right"> <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalAddParameter"> ADD </button> </span>
                                    </div>
                                    <div class="tab-pane fade" id="tab-employment_type" role="tabpanel">
                                        <span class="card-title text-left">MANAGE <span>EMPLOYMENT TYPE</span> INFORMATION </span>
                                        <span class="float-right"> <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalAddParameter"> ADD </button> </span>
                                    </div>
                                </div>




                            </div>
                        </div>
                        <textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short>&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href=&quot;https://ckeditor.com/&quot;&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>
  
                    </div>
                </div>
            </div>






        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>