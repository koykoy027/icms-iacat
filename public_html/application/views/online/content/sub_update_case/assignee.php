<?php
/**
 * Page Security
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="form-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class=" card-sub-title txt-W-500">Assignee<br>
                        <small class="card-desc">List of Assignee of cases of your branch agency.</small>
                    </div>
                </div>
            </div>
            <div class="card card_tbl-container card-height">

                <table class="table">
                    <thead class="thead-grey">
                        <tr>
                            <th scope="col">
                                <div class="row">
                                    <div class="col-6">
                                        User
                                    </div>
                                    <div class="col-4">
                                        Role
                                    </div>
                                    <div class="col-2">
                                        Status
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tbl-services-list" id="tbl-list-assignee">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>