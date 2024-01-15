<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="page-content-inner">
    <div class="content-body">    
        <div class="card p1rem">
            <div class="content-body-container" >


                <div class=" card-stats-inner " >
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <div class="card-title">
                                <p> Activity Logs </p>
                                <small class="card-desc"> List of all activity logs.</small>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="act-log-container">
                                <table class="table ">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th width="10%"></th>
                                            <th width="60%">Action</th>
                                            <th width="15%">Date / Time</th>
                                            <th width="15%"> Duration </th>
                                        </tr>
                                    </thead>
                                    <tbody class="activity-logs-content" id="activity_log_container" datapage="1" datapageend="0">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>